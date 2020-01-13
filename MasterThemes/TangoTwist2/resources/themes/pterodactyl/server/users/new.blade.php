{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.master')

@section('title')
    @lang('server.users.new.header')
@endsection

@section('content')
					<div class="row">
						<div class="col-xl-12">
							<div class="card flex-fill w-100">
								<div class="card-header">
									<h5 class="card-title mb-0">Add user</h5>
								</div>
								<div class="card-body py-3">
<?php $oldInput = array_flip(is_array(old('permissions')) ? old('permissions') : []) ?>
<form action="{{ route('server.subusers.new', $server->uuidShort) }}" method="POST">
    <div class="row">
        <div class="col-sm-12">
            <div class="box box-primary">
                <div class="box-header with-border">
                    <div class="form-group">
                        <label class="control-label">Email</label>
                        <div>
                            {!! csrf_field() !!}
                            <input type="email" class="form-control" name="email" value="{{ old('email') }}" />
                            <p class="text-muted small">Enter the email address of the person you want to add.</p>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="btn-group pull-left">
                        <a style="color:#FFFFFF;" id="selectAllCheckboxes" class="btn btn-sm btn-primary">Select all</a>
			<a style="color:#FFFFFF;" id="unselectAllCheckboxes" class="btn btn-sm btn-primary">Select none</a>
                    </div>
                    <input type="submit" name="submit" value="Add" class="pull-right btn btn-sm btn-primary" />
                </div>
            </div>
        </div>
    </div>
<br>
    <div class="row">
        @foreach($permissions as $block => $perms)
            <div class="col-sm-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">@lang('server.users.new.' . $block . '_header')</h3>
                    </div>
                    <div class="box-body">
                        @foreach($perms as $permission => $daemon)
                            <div class="form-group">
                                <div class="checkbox checkbox-primary no-margin-bottom">
                                    <input id="{{ $permission }}" name="permissions[]" type="checkbox" value="{{ $permission }}"/>
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
            @if ($loop->iteration % 2 === 0)
                <div class="clearfix visible-lg-block visible-md-block visible-sm-block"></div>
            @endif
        @endforeach
    </div>
</form>
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
