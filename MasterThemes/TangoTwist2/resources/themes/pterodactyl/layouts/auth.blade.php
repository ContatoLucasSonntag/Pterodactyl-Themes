{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="/themes/spark/css/app.css" rel="stylesheet">
	<script src="/themes/spark/js/app.js"></script>
	<meta name="_token" content="{{ csrf_token() }}">
	<link rel="icon" type="image/png" href="/favicons/favicon.png" />
        <meta name="theme-color" content="#064475">
	
	<title>{{ config('app.name', 'Pterodactyl') }}</title>
	
	@include('layouts.scripts')
	@show
	
	@section('scripts')
        {!! Theme::css('vendor/sweetalert/sweetalert.min.css?t={cache-version}') !!}
        {!! Theme::css('vendor/animate/animate.min.css?t={cache-version}') !!}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    @show

</head>
                @yield('content')
    </body>
</html>
