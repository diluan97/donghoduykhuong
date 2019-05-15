<div class="modal-dialog" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Đăng nhập</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">

				
					<div>
						<label class="form-input">Email</label>
						<input type="email" class="form-control" name="email">
						@if ($errors->has('email'))
                            <p class="help is-danger"style="color:red">{{ $errors->first('email') }}</p>
                        @endif
					</div>
					<div>
					    <label class="form-input">Mật khẩu</label>
					     <input type="password" class="form-control" name="password">
						 @if ($errors->has('password'))
                            <p class="help is-danger"style="color:red">{{ $errors->first('password') }}</p>
                        @endif
					</div>
				
					
				</div>
				
				<div class="modal-footer">
					<button type="submit" class="btn btn-secondary" >Đăng nhập</button>
			
				</div>
				</div>
			</div>