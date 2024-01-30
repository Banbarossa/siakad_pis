<x-guest-layout>



	<div class="d-flex justify-content-center mt-5">
		<div class="login-box">
	
			<div class="card">
				<div class="card-body login-card-body">
					<p class="login-box-msg">Lupa Kata sandi, masukkan email untuk memulihkan kata sandi anda.
					</p>
	
					<form action="{{ route('password.email') }}" method="post">
						@csrf
	
						<div class="input-group mb-3">
							<input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email"
								placeholder="Masukkan Email" value="{{ old('email') }}" required
								autofocus>
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-lock"></span>
								</div>
							</div>
							@error('email')
							<div class="invalid-feedback">
								{{$message}}
							</div>
							@enderror
						</div>
						<div class="row">
							<div class="col-12">
								<button type="submit" class="btn btn-primary btn-block">Reset Password</button>
							</div>
						</div>
					</form>
	
					<div class="mt-3 mb-1">
						<a class="btn btn-default" href="/"><i class="fas fa-sign-in-alt mr-2"></i>Login</a>
					</div>
				</div>
			</div>
		</div>

	</div>



</x-guest-layout>
