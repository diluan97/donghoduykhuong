<?php

namespace App\Http\Controllers\Guest;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;


use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;

use App\Models\Order;

use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Session;
use URL;
use Redirect;
use Cart;

class PayMentController extends Controller
{
    private $_api_context;

    public function __construct(Request $request)
    {
        $payal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $payal_conf['client_id'],
            $payal_conf['secret']
        ));
        $this->_api_context->setConfig($payal_conf['settings']);

    }

    public function getPayPal()
    {
        $url = "https://www.vietcombank.com.vn/ExchangeRates/ExrateXML.aspx";
        $tygia = file_get_contents($url);
        $xml = simplexml_load_string($tygia);
        $arr = json_decode(json_encode($xml), 1);
        $data = end($arr);

        foreach ($arr['Exrate'] as $k => $v) {

            $array = $v['@attributes'];

        }
        $binary = $array['Transfer'];
        $price = Cart::subtotal(0, '.', '') / $binary;

        $usd = round($price, 2);


        return view('guest.paypal.paypal')->with([
            'tygia' => $binary,
            'usd' => $usd,
        ]);

    }



    public function payPayPal(Request $request)
    {

        //PRICE PAYPAL
        $url = "https://www.vietcombank.com.vn/ExchangeRates/ExrateXML.aspx";
        $tygia = file_get_contents($url);
        $xml = simplexml_load_string($tygia);
        $arr = json_decode(json_encode($xml), 1);
        $data = end($arr);

        foreach ($arr['Exrate'] as $k => $v) {

            $array = $v['@attributes'];

        }
        $binary = $array['Transfer'];
        $price = Cart::subtotal(0, '.', '') / $binary;

        $usd = round($price, 2);


        $payer = new Payer();
        $payer->setPaymentMethod("paypal");
        $order = Order::with('productOrders')->latest()->first();
        $orderNumber = $order->order_number;
        $item1 = new Item();
        $item1->setName('Thanh Toán Đơn Hàng Số ' . $orderNumber)
            ->setCurrency('USD')
            ->setQuantity(1)
            ->setPrice($usd);
            // $item2 = new Item();
            // $item2->setName('Granola bars')
            //     ->setCurrency('USD')
            //     ->setQuantity(5)
            //     ->setSku("321321") // Similar to item_number in Classic API
            //     ->setPrice(2);

        $itemList = new ItemList();
        $itemList->setItems(array($item1));

            // $details = new Details();
            // $details->setShipping(1.2)
            //     ->setTax(1.3)
            //     ->setSubtotal(17.50);

        // GET GIA PAYPAL



        $amount = new Amount();
        $amount->setCurrency("USD")
            ->setTotal($request->get('amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($itemList)
            ->setDescription("Payment description");

        $redirectUrls = new RedirectUrls();

        $redirectUrls->setReturnUrl(URL::to('status'))
            ->setCancelUrl(URL::to('status'));
        // if ($redirectUrls) {
        //     $order = Order::with('productOrders')->latest()->first();
        //     $id = $order->id;
        //     $delete = Order::findOrFail($id);
        //     $delete->delete();
        //     Cart::destroy();
        // }

        $payment = new Payment();
        $payment->setIntent("sale")
            ->setPayer($payer)
            ->setRedirectUrls($redirectUrls)
            ->setTransactions(array($transaction));
            // $request = clone $payment;

        try {
            $payment->create($this->_api_context);
        } catch (Exception $ex) {
                // ResultPrinter::printError("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", null, $request, $ex);
                // exit(1);
            if (\Config::get('app.debug')) {

                \Session::put('error', 'Connection timeout');
                return redirect('/');
            } else {

                \Session::put('error', 'Co loi gi do , xin loi cap nhat lai');
                return redirect('/');
            }
        }
            // $approvalUrl = $payment->getApprovalLink();
            // ResultPrinter::printResult("Created Payment Using PayPal. Please visit the URL to Approve.", "Payment", "<a href='$approvalUrl' >$approvalUrl</a>", $request, $payment);

        foreach ($payment->getLinks() as $link) {
            if ($link->getRel() == 'approval_url') {
                $redirectUrls = $link->getHref();
                break;
            }
        }

        Session::put('paypal_payment_id', $payment->getId());
        if (isset($redirectUrls)) {
            return Redirect::away($redirectUrls);
        }

        \Session::put('error', 'Unknow error occurred');
        return redirect('/');

    }
    public function getPayMentStatus(Request $request)
    {
        $payment_id = Session::get('paypal_payment_id');
        $request->session()->forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
            \Session::put('error', 'Payment Failed');
            return redirect()->route('home');
        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->SetPayerId(Input::get('PayerID'));

        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {
            Cart::destroy();
            $order = Order::with('productOrders')->latest()->first();
            $order->order_status = 'D';
            $order->save();
            \Session::put('Success', 'Payment Success');

            return redirect()->route('home');


        }
        $order = Order::with('productOrders')->latest()->first();
        $id = $order->id;
        $delete = Order::findOrFail($id);
        $delete->delete();
        \Session::put('error', 'Payment Failed');
        return redirect()->route('home');
    }
}