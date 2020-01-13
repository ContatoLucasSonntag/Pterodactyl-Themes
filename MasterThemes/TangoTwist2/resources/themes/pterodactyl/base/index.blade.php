{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.master')

@section('title')
    @lang('base.index.header')
@endsection

@section('content-header')
    <h1>@lang('base.index.header')<small>@lang('base.index.header_sub')</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">@lang('strings.home')</a></li>
        <li class="active">@lang('strings.servers')</li>
    </ol>
@endsection

@section('content')

					<div class="row">
						<div class="col-xl-12">
							<div class="card flex-fill w-100">
								<div class="card-header">
									<h5 class="card-title mb-0">Servers</h5>
								</div>
								<div class="card-body py-3">

                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>Server</th>
                            <th>@lang('strings.node')</th>
                            <th>Connection</th>
                            <th>Expiration date</th>
                            <th class="text-center hidden-sm hidden-xs">Memory</th>
                            <th class="text-center hidden-sm hidden-xs">CPU</th>
                            <th class="text-center hidden-sm hidden-xs">Support ID</th>
                        </tr>
                        @foreach($servers as $server)
                            <tr class="dynamic-update" data-server="{{ $server->uuidShort }}">
                                <td><a href="{{ route('server.index', $server->uuidShort) }}">{{ $server->name }}</a></td>
                                <td>{{ $server->getRelation('node')->name }}</td>
                                <td><code>{{ $server->getRelation('allocation')->alias }}:{{ $server->getRelation('allocation')->port }}</code></td>
                                <td>{{ $server->description }}</td>
                                <td class="text-center hidden-sm hidden-xs"><span data-action="memory">--</span> / {{ $server->memory === 0 ? '∞' : $server->memory }} MB</td>
                                <td class="text-center hidden-sm hidden-xs"><span data-action="cpu" data-cpumax="{{ $server->cpu }}">--</span> %</td>
				<td class="text-center"><i class="fas fa-ticket-alt"></i> <strong>{{ $server->uuidShort }}</strong></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

            </div>
            @if($servers->hasPages())
                <div class="box-footer">
                    <div class="col-md-12 text-center">{!! $servers->appends(['query' => Request::input('query')])->render() !!}</div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
    @parent
    <script>
        $('tr.server-description').on('mouseenter mouseleave', function (event) {
            $(this).prev('tr').css({
                'background-color': (event.type === 'mouseenter') ? '#f5f5f5' : '',
            });
        });
    </script>
    {!! Theme::js('js/frontend/serverlist.js') !!}
@endsection
