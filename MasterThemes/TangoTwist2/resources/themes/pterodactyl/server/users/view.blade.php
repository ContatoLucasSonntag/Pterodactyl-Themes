{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.master')

@section('title')
    @lang('server.users.new.header')
@endsection

@section('content')
@can('edit-subuser', $server)
<form action="{{ route('server.subusers.view', [ 'uuid' => $server->uuidShort, 'subuser' => $subuser->hashid ]) }}" method="POST">
@endcan
					<div class="row">
						<div class="col-xl-12">
							<div class="card flex-fill w-100">
								<div class="card-header">
									<h5 class="card-title mb-0">Edit user</h5>
								</div>
								<div class="card-body py-3">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <div>
                            {!! csrf_field() !!}
                            <input type="email" class="form-control" disabled value="{{ $subuser->user->email }}" />
                        </div>
                    </div>
                </div>
                @can('edit-subuser', $server)
                    <div class="box-body">
                        <div class="btn-group pull-left">
                            <a id="selectAllCheckboxes" style="color:#FFFFFF;" class="btn btn-sm btn-primary">Select all</a>
                            <a id="unselectAllCheckboxes" style="color:#FFFFFF;" class="btn btn-sm btn-primary">Select none</a>
                        </div>
                        {!! method_field('PATCH') !!}
                        <input type="submit" name="submit" value="Update" class="pull-right btn btn-sm btn-primary" />
                    </div>
                @endcan
            </div>
        </div>
    </div>
    <div class="row">
        @foreach($permlist as $block => $perms)
            <div class="col-sm-6">
							<div class="card flex-fill w-100">
								<div class="card-header">
									<h5 class="card-title mb-0">@lang('server.users.new.' . $block . '_header')</h5>
								</div>
								<div class="card-body py-3">
                    <div class="box-body">
                        @foreach($perms as $permission => $daemon)
                            <div class="form-group">
                                <div class="checkbox checkbox-primary no-margin-bottom">
                                    <input id="{{ $permission }}" name="permissions[]" type="checkbox" @if(isset($permissions[$permission]))checked="checked"@endif @cannot('edit-subuser', $server)disabled="disabled"@endcannot value="{{ $permission }}"/>
                                    <label for="{{ $permission }}" class="strong">
                                        @lang('server.users.new.' . str_replace('-', '_', $permission) . '.title')
                                    </label>
                                </div>
                                <p class="text-muted small">@lang('server.users.new.' . str_replace('-', '_', $permission) . '.description')</p>
                            </div>
                        @endforeach
                    </div>
</div>
                </div>
            </div>
            @if ($loop->iteration % 2 === 0)
                <div class="clearfix visible-lg-block visible-md-block visible-sm-block"></div>
            @endif
        @endforeach
    </div>
@can('edit-subuser', $server)
</form>
@endcan
@endsection

@section('footer-scripts')
    @parent
    {!! Theme::js('js/frontend/server.socket.js') !!}
    <script type="text/javascript">
        $(document).ready(function () {
            $('#selectAllCheckboxes').on('click', function () {
                $('input[type=checkbox]').prop('checked', true);
            });
            $('#unselectAllCheckboxes').on('click', function () {
                $('input[type=checkbox]').prop('checked', false);
            });
        })
    </script>
@endsection
