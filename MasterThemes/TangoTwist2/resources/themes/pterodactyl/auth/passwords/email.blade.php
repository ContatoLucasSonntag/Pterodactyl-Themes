{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.auth')

@section('title')
    Forgot Password
@endsection

@section('content')
	<main class="main h-100 w-100">
		<div class="container h-100">
			<div class="row h-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">Forgot Password</h1>
							<p class="lead">
								Enter your email to reset a password.
							</p>
						</div>

        @if (count($errors) > 0)
            <div class="alert alert-danger">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                @lang('auth.auth_error')<br><br>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if (session('status'))
            <div class="alert alert-success">
                @lang('auth.email_sent')
            </div>
        @endif

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
									<form action="{{ route('auth.password') }}" method="POST">
										<div class="form-group">
											<label>Email</label>
											<input type="email" name="email" class="form-control input-lg" value="{{ old('email') }}" required placeholder="@lang('strings.email')" autofocus>
										</div>
                    @if ($errors->has('email'))
                        <span class="help-block text-red small">
                            {{ $errors->first('email') }}
                        </span>
                    @endif
										<div class="text-center mt-3">
                    {!! csrf_field() !!}
                    <button type="submit" class="btn btn-primary g-recaptcha pterodactyl-login-button--main" @if(config('recaptcha.enabled')) data-sitekey="{{ config('recaptcha.website_key') }}" data-callback='onSubmit' @endif>Wachtwoord opvragen</button>
										</div>
									</form>
								</div>
							</div>
						</div>

					</div>
				</div>
			</div>
		</div>
	</main>
@endsection

@section('scripts')
    @parent
    @if(config('recaptcha.enabled'))
        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
        <script>
        function onSubmit(token) {
            document.getElementById("resetForm").submit();
        }
        </script>
     @endif
@endsection
