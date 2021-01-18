@extends('layouts.appLogin')

@section('content')
<!-- end page loader -->
<div class="container pt-5">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="{{ asset('image/triage1.png')}}" class="image-fluid" width="160" alt="Logo">
					</div>
				</div>
				<div class="d-flex justify-content-center form_container">
					<form action="{{route('login')}}" method="post" autocomplete="off">
                    @csrf 
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="text" name="username" class="form-control input_user @error('username') is-invalid @enderror" value="{{ old('username') }}" placeholder="username">
						</div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="password" class="form-control input_pass" placeholder="password">
						</div>
						
							<div class="d-flex justify-content-center mt-3 login_container">
				 	<button name="button" class="btn login_btn">Login</button>
				   </div>
					</form>
				</div>
		
				<div class="mt-4">
					<div class="d-flex justify-content-center links text-light">
						Don't have an account? <a href="#" class="ml-2" data-toggle="modal" data-target="#modal_signUp">Sign Up</a>
					</div>
					<div class="d-flex justify-content-center links text-light">
						How to register? <a href="{{asset('files/citizenReg.pdf')}}" class="ml-2" target="_blank">Click here</a>
					</div>
				</div>
			</div>
		</div>
	</div>

    <div class="modal fade" id="modal_signUp" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-body bg-choco">
        <div class="row">
            <div class="col-md-6 mb-2">
                <a href="javascript:void(0)" id="establishment_btn" class="text-choco" onclick="chooseMenu('establishment')" data-dismiss="modal">
                    <div class="card card-body text-center shadow bg-light" >
                        <div class="row">
                            <div class="col-md-12">
                                <h3><i class="fas fa-building"></i></h3>
                            </div>
                            <div class="col-md-12">
                                <h3>Establishment</h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-6">
                <a  class="text-choco" onclick="chooseMenu('citizen')" data-dismiss="modal" href="javascript:void(0)">
                    <div class="card card-body text-center shadow bg-light" >
                        <div class="row">
                            <div class="col-md-12">
                                <h3><i class="fas fa-user    "></i></h3>
                            </div>
                            <div class="col-md-12">
                                <h3>Citizen</h3>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('scripts')
    <script>
        function chooseMenu(menu) {
            if(menu == 'establishment'){
                window.location.href = "/establishment/create";
            }else if(menu == 'citizen'){
                window.location.href = "/client/create";
            }
        }
    </script>
@endsection