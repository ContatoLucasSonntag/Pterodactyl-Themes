{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.auth')

@section('title')
    Login
@endsection

@section('content')
	<main class="main h-100 w-100">
		<div class="container h-100">
			<div class="row h-100">
				<div class="col-sm-10 col-md-8 col-lg-6 mx-auto d-table h-100">
					<div class="d-table-cell align-middle">

						<div class="text-center mt-4">
							<h1 class="h2">{{ config('app.name', 'Pterodactyl') }}</h1>
							<p class="lead">
								Login to the control panel
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
        @foreach (Alert::getMessages() as $type => $messages)
            @foreach ($messages as $message)
                <div class="callout callout-{{ $type }} alert-dismissable" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {!! $message !!}
                </div>
            @endforeach
        @endforeach

						<div class="card">
							<div class="card-body">
								<div class="m-sm-4">
        <form id="loginForm" action="{{ route('auth.login') }}" method="POST">
										<div class="form-group">
											<label>Email</label>
											<input type="text" name="user" class="form-control input-lg" value="{{ old('user') }}" required placeholder="@lang('strings.user_identifier')" autofocus>
										</div>
										<div class="form-group">
											<label>Password</label>
											<input type="password" name="password" class="form-control input-lg" required placeholder="@lang('strings.password')">
											<small>
            <a href="{{ route('auth.password') }}">Forgot Password?</a>
          </small>
										</div>
										<div class="text-center mt-3">
											{!! csrf_field() !!}
											<button type="submit" class="btn btn-primary g-recaptcha" @if(config('recaptcha.enabled')) data-sitekey="{{ config('recaptcha.website_key') }}" data-callback='onSubmit' @endif>@lang('auth.sign_in')</button>
										</div>
									</form>
								</div>
							</div>
							<div class="card-footer">
								<center>
									<p>Made with love by </p><a href="https://mrkevko.nl">Kevko</a>
								</center>
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
            document.getElementById("loginForm").submit();
        }
        </script>
     @endif
@endsection
