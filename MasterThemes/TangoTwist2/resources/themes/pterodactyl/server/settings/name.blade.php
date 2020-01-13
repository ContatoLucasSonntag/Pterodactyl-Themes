{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.master')

@section('title')
    @lang('server.config.name.header')
@endsection

@section('content-header')
    <h1>@lang('server.config.name.header')<small>@lang('server.config.name.header_sub')</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">@lang('strings.home')</a></li>
        <li><a href="{{ route('server.index', $server->uuidShort) }}">{{ $server->name }}</a></li>
        <li>@lang('navigation.server.configuration')</li>
        <li class="active">@lang('navigation.server.server_name')</li>
    </ol>
@endsection

@section('content')
					<div class="row">
						<div class="col-xl-12">
							<div class="card flex-fill w-100">
								<div class="card-header">
									<h5 class="card-title mb-0">Server name</h5>
								</div>
								<div class="card-body py-3">
            <form action="{{ route('server.settings.name', $server->uuidShort) }}" method="POST">
                <div class="box">
                    <div class="box-body">
                        <div class="form-group no-margin-bottom">
                            <label class="control-label" for="pServerName">@lang('server.config.name.header')</label>
                            <div>
                                <input type="text" name="name" id="pServerName" class="form-control" value="{{ $server->name }}" />
                                <p class="small text-muted no-margin-bottom">This name is only displayed in the control panel, so it has no change in the game.</p>
                            </div>
                        </div>
                    </div>
                    <div class="box-footer">
                        {{ method_field('PATCH') }}
                        {{ csrf_field() }}
                        <input type="submit" class="btn btn-sm btn-primary pull-right" value="Save" />
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('footer-scripts')
    @parent
    {!! Theme::js('js/frontend/server.socket.js') !!}
@endsection
