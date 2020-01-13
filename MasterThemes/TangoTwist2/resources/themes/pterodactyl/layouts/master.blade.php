<!DOCTYPE html>
<html lang="en">
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
	
	@section('scripts')
        {!! Theme::css('vendor/sweetalert/sweetalert.min.css?t={cache-version}') !!}
        {!! Theme::css('vendor/animate/animate.min.css?t={cache-version}') !!}
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    @show

</head>
<body class="theme-blue">

	<div class="wrapper">
		<nav id="sidebar" class="sidebar">
			<a class="sidebar-brand" href="{{ route('index') }}">
           		 {{ config('app.name', 'Pterodactyl') }}
         		 </a>
			<div class="sidebar-content">
				<div class="sidebar-user">
					<img src="https://www.gravatar.com/avatar/{{ md5(strtolower(Auth::user()->email)) }}?s=160" class="img-fluid rounded-circle mb-2" alt="Profilephoto" />
					<div class="font-weight-bold">{{ Auth::user()->name_first }} {{ Auth::user()->name_last }}</div>
					<small>{{ Auth::user()->username }}</small>
				</div>

				<ul class="sidebar-nav">
					<li class="sidebar-header">
						General
					</li>
					<li class="sidebar-item {{ Route::currentRouteName() !== 'index' ?: 'active' }}">
						<a class="sidebar-link" href="{{ route('index')}}">
      					<i class="align-middle mr-2 fas fa-server"></i> <span class="align-middle">Servers</span>
      				</a>
					</li>
					<li class="sidebar-item">
						<a href="#layouts" data-toggle="collapse" class="sidebar-link collapsed">
      					<i class="align-middle mr-2 fas fa-user"></i> <span class="align-middle">Account</span>
              </a>
						<ul id="layouts" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
							<li class="sidebar-item {{ Route::currentRouteName() !== 'account' ?: 'active' }}"><a class="sidebar-link" href="{{ route('account') }}"><i class="fas fa-user-circle"></i> Account</a></li>
							<li class="sidebar-item {{ Route::currentRouteName() !== 'account.security' ?: 'active' }}"><a class="sidebar-link" href="{{ route('account.security')}}"><i class="fas fa-fingerprint"></i> Security</a></li>
						</ul>
					</li>
                        @if (isset($server->name) && isset($node->name))
					<li class="sidebar-header">
						Server
					</li>
					<li class="sidebar-item {{ Route::currentRouteName() !== 'server.index' ?: 'active' }}">
						<a class="sidebar-link" href="{{ route('server.index', $server->uuidShort) }}">
                				<i class="align-middle mr-2 fa fa-terminal"></i> <span class="align-middle">Console</span>
             					</a>
					</li>

					@can('list-files', $server)
					<li @if(starts_with(Route::currentRouteName(), 'server.files')) class="sidebar-item active" @endif">
						<a class="sidebar-link" href="{{ route('server.files.index', $server->uuidShort) }}">
                				<i class="align-middle mr-2 fas fa-file"></i> <span class="align-middle">Files</span>
             					</a>
					</li>
					@endcan

					@can('list-subusers', $server)
					<li @if(starts_with(Route::currentRouteName(), 'server.subusers')) class="sidebar-item active" @endif">
						<a class="sidebar-link" href="{{ route('server.subusers', $server->uuidShort)}}">
                				<i class="align-middle mr-2 fas fa-users"></i> <span class="align-middle">Users</span>
             					</a>
					</li>
					@endcan

					@can('list-schedules', $server)
					<li @if(starts_with(Route::currentRouteName(), 'server.schedules')) class="sidebar-item active" @endif">
						<a class="sidebar-link" href="{{ route('server.schedules', $server->uuidShort)}}">
                				<i class="align-middle mr-2 far fa-clock"></i> <span class="align-middle">Schedules</span>
             					</a>
					</li>
					@endcan

					@can('view-databases', $server)
					<li @if(starts_with(Route::currentRouteName(), 'server.databases')) class="sidebar-item active" @endif">
						<a class="sidebar-link" href="{{ route('server.databases.index', $server->uuidShort)}}">
                				<i class="align-middle mr-2 fas fa-database"></i> <span class="align-middle">Databases</span>
             					</a>
					</li>
					@endcan

					@if(Gate::allows('view-startup', $server) || Gate::allows('access-sftp', $server) ||  Gate::allows('view-allocations', $server))
					<li @if(starts_with(Route::currentRouteName(), 'server.settings')) class="sidebar-item active" @endif">
					<a href="#forms" data-toggle="collapse" class="sidebar-link collapsed">
      					<i class="align-middle mr-2 fas fa-cogs"></i> <span class="align-middle">Configuration</span>
           				   </a>
						<ul id="forms" class="sidebar-dropdown list-unstyled collapse " data-parent="#sidebar">
							@can('view-name', $server)
							<li class="sidebar-item"><a class="sidebar-link {{ Route::currentRouteName() !== 'server.settings.name' ?: 'active' }}" href="{{ route('server.settings.name', $server->uuidShort) }}">Server name</a></li>
							@endcan
							@can('view-allocations', $server)
							<li class="sidebar-item"><a class="sidebar-link {{ Route::currentRouteName() !== 'server.settings.allocation' ?: 'active' }}" href="{{ route('server.settings.allocation', $server->uuidShort) }}">Allocation</a></li>
							@endcan
							@can('access-sftp', $server)
							<li class="sidebar-item"><a class="sidebar-link {{ Route::currentRouteName() !== 'server.settings.sftp' ?: 'active' }}" href="{{ route('server.settings.sftp', $server->uuidShort) }}">SFTP</a></li>
							@endcan
							@can('view-startup', $server)
							<li class="sidebar-item"><a class="sidebar-link {{ Route::currentRouteName() !== 'server.settings.startup' ?: 'active' }}" href="{{ route('server.settings.startup', $server->uuidShort) }}">Startup command</a></li>
							@endcan
						</ul>
					</li>
					@endif
                        	@endif
			</ul>
		</div>
	</nav>
	<div class="main">
		<nav class="navbar navbar-expand navbar-dark">
			<a class="sidebar-toggle d-flex mr-2">
           			<i class="hamburger align-self-center"></i>
          		</a>

				<form action="{{ route('index') }}" method="GET" class="form-inline d-none d-sm-inline-block">
					<input class="form-control form-control-lite" type="text" name="query" placeholder="Search...">
				</form>

				<div class="navbar-collapse collapse">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item dropdown ml-lg-2">
							<a class="nav-link dropdown-toggle" href="#" id="userDropdown" data-toggle="dropdown">
                <i class="align-middle fas fa-bars"></i>
              </a>
							<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
								<a class="dropdown-item" href="{{ route('account') }}"><i class="align-middle mr-1 fas fa-user"></i> Account</a>
								<a class="dropdown-item" href="{{ route('account.security')}}"><i class="align-middle mr-1 fas fa-fingerprint"></i> Security</a>
								@if(Auth::user()->root_admin)
								<a class="dropdown-item" href="{{ route('admin.index') }}"><i class="align-middle mr-1 fas fa-cogs"></i> Administration</a>
								@endif
								<div class="dropdown-divider"></div>
								<a style="color:#e24646;" class="dropdown-item" href="{{ route('auth.logout') }}"><i style="color:#e24646;" class="align-middle mr-1 fas fa-sign-out-alt"></i> Logout</a>
							</div>
						</li>
					</ul>
				</div>

			</nav>
			<main class="content">
				<div class="container-fluid">

					<div class="header text-center">
						<h1 class="header-title">
							Welcome back, {{ Auth::user()->name_first }}
						</h1>
						<p class="header-subtitle">At the moment you have {{ Auth::user()->servers->count() }} server(s) in use.</p>
					</div>

                            @if (count($errors) > 0)
<div class="alert alert-warning alert-dismissible" role="alert">
<div class="alert-icon">
<i class="far fa-fw fa-bell"></i>
</div>
<div class="alert-message">
                                    The following error has occurred:<br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
              </button>
										</div>
                            @endif
                            @foreach (Alert::getMessages() as $type => $messages)
                                @foreach ($messages as $message)
<div class="alert alert-info alert-dismissible" role="alert">
<div class="alert-icon">
<i class="far fa-fw fa-bell"></i>
</div>
<div class="alert-message">
                                    {!! $message !!}
                                </div>
											<button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true"><i class="fas fa-times"></i></span>
              </button>
										</div>
                                @endforeach
                            @endforeach

@yield('content')

				</div>
			</main>
			<footer class="footer">
				<div class="container-fluid">
					<div class="row text-muted">
						<div class="col-8 text-left"></div>
						<div class="col-4 text-right">
							<p class="mb-0">
								&copy; Copyright AgentJDG - Spark
							</p>
						</div>
					</div>
				</div>
			</footer>
		</div>

	</div>
        @section('footer-scripts')
            {!! Theme::js('js/keyboard.polyfill.js?t={cache-version}') !!}
            <script>keyboardeventKeyPolyfill.polyfill();</script>

            {!! Theme::js('js/laroute.js?t={cache-version}') !!}
            {!! Theme::js('vendor/jquery/jquery.min.js?t={cache-version}') !!}
            {!! Theme::js('vendor/sweetalert/sweetalert.min.js?t={cache-version}') !!}
            {!! Theme::js('vendor/bootstrap/bootstrap.min.js?t={cache-version}') !!}
            {!! Theme::js('vendor/slimscroll/jquery.slimscroll.min.js?t={cache-version}') !!}
            {!! Theme::js('vendor/adminlte/app.min.js?t={cache-version}') !!}
            {!! Theme::js('vendor/socketio/socket.io.v203.min.js?t={cache-version}') !!}
            {!! Theme::js('vendor/bootstrap-notify/bootstrap-notify.min.js?t={cache-version}') !!}
            {!! Theme::js('js/autocomplete.js?t={cache-version}') !!}

            @if(Auth::user()->root_admin)
                <script>
                    $('#logoutButton').on('click', function (event) {
                        event.preventDefault();
                        var that = this;
                        swal({
                            title: 'Do you want to log out?',
                            type: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d9534f',
                            cancelButtonColor: '#d33',
                            confirmButtonText: 'Log out'
                        }, function () {
                            window.location = $(that).attr('href');
                        });
                    });
                </script>
            @endif
        @show
</body>
</html>