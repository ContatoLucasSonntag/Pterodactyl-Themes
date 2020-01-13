{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.master')

@section('title')
    @lang('server.config.sftp.header')
@endsection

@section('content-header')
    <h1>@lang('server.config.sftp.header')<small>@lang('server.config.sftp.header_sub')</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">@lang('strings.home')</a></li>
        <li><a href="{{ route('server.index', $server->uuidShort) }}">{{ $server->name }}</a></li>
        <li>@lang('navigation.server.configuration')</li>
        <li class="active">@lang('navigation.server.sftp_settings')</li>
    </ol>
@endsection

@section('content')
					<div class="row">
						<div class="col-xl-12">
							<div class="card flex-fill w-100">
								<div class="card-header">
									<h5 class="card-title mb-0">SFTP beheer</h5>
								</div>
								<div class="card-body py-3">
        <div class="box">
            <div class="box-body">
                <div class="form-group">
                    <label class="control-label">Connection</label>
                    <div>
                        <input type="text" class="form-control" readonly value="sftp://{{ $node->fqdn }}:{{ $node->daemonSFTP }}" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">Username</label>
                    <div>
                        <input type="text" class="form-control" readonly value="{{ auth()->user()->username }}.{{ $server->uuidShort }}" />
                    </div>
                </div>
                <div class="form-group">
                    <label for="password" class="control-label">Password</label>
                    <div>
                        <input type="text" class="form-control" readonly value="The password is the same as your account." />
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
    @parent
    {!! Theme::js('js/frontend/server.socket.js') !!}
@endsection
