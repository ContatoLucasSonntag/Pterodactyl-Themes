{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.master')

@section('title')
    @lang('server.config.allocation.header')
@endsection

@section('content-header')
    <h1>@lang('server.config.allocation.header')<small>@lang('server.config.allocation.header_sub')</small></h1>
    <ol class="breadcrumb">
        <li><a href="{{ route('index') }}">@lang('strings.home')</a></li>
        <li><a href="{{ route('server.index', $server->uuidShort) }}">{{ $server->name }}</a></li>
        <li>@lang('navigation.server.configuration')</li>
        <li class="active">@lang('navigation.server.port_allocations')</li>
    </ol>
@endsection

@section('content')
					<div class="row">
						<div class="col-xl-12">
							<div class="card flex-fill w-100">
								<div class="card-header">
									<h5 class="card-title mb-0">Allocation</h5>
								</div>
								<div class="card-body py-3">
        <div class="box">
            <div class="box-body table-responsive no-padding">
                <table class="table table-hover">
                    <tbody>
                        <tr>
                            <th>@lang('strings.ip')</th>
                            <th>Domain</th>
                            <th>Port</th>
                        </tr>
                        @foreach ($allocations as $allocation)
                            <tr>
                                <td>
                                    <code>{{ $allocation->ip }}</code>
                                </td>
                                <td class="middle">
                                    @if(is_null($allocation->ip_alias))
                                        <span class="label label-default">@lang('strings.none')</span>
                                    @else
                                        <code>{{ $allocation->ip_alias }}</code>
                                    @endif
                                </td>
                                <td><code>{{ $allocation->port }}</code></td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footer-scripts')
    @parent
    {!! Theme::js('js/frontend/server.socket.js') !!}
    <script>
        $(document).ready(function () {
            @can('edit-allocation', $server)
            (function triggerClickHandler() {
                $('a[data-action="set-default"]:not(.disabled)').click(function (e) {
                    $('#toggleActivityOverlay').removeClass('hidden');
                    e.preventDefault();
                    var self = $(this);
                    $.ajax({
                        type: 'PATCH',
                        url: Router.route('server.settings.allocation', { server: Pterodactyl.server.uuidShort }),
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content'),
                        },
                        data: {
                            'allocation': $(this).data('allocation')
                        }
                    }).done(function () {
                        self.parents().eq(2).find('a[role="button"]').removeClass('btn-success disabled').addClass('btn-default').html('{{ trans('strings.make_primary') }}');
                        self.removeClass('btn-default').addClass('btn-success disabled').html('{{ trans('strings.primary') }}');
                    }).fail(function(jqXHR) {
                        console.error(jqXHR);
                        var error = 'An error occurred while trying to process this request.';
                        if (typeof jqXHR.responseJSON !== 'undefined' && typeof jqXHR.responseJSON.error !== 'undefined') {
                            error = jqXHR.responseJSON.error;
                        }
                        swal({type: 'error', title: 'Whoops!', text: error});
                    }).always(function () {
                        triggerClickHandler();
                        $('#toggleActivityOverlay').addClass('hidden');
                    })
                });
            })();
            @endcan
        });
    </script>
@endsection
