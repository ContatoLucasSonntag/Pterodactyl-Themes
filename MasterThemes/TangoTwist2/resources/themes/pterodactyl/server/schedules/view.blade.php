{{-- Pterodactyl - Panel --}}
{{-- Copyright (c) 2015 - 2017 Dane Everitt <dane@daneeveritt.com> --}}

{{-- This software is licensed under the terms of the MIT license. --}}
{{-- https://opensource.org/licenses/MIT --}}
@extends('layouts.master')

@section('title')
    @lang('server.schedules.edit.header')
@endsection

@section('scripts')
    {{-- This has to be loaded before the AdminLTE theme to avoid dropdown issues. --}}
    {!! Theme::css('vendor/select2/select2.min.css') !!}
    @parent
@endsection

@section('content')
<form action="{{ route('server.schedules.view', ['server' => $server->uuidShort, 'schedule' => $schedule->hashid]) }}" method="POST">
					<div class="row">
						<div class="col-xl-12">
							<div class="card flex-fill w-100">
								<div class="card-header">
									<h5 class="card-title mb-0">Taken</h5>
								</div>
								<div class="card-body py-3">
                    <div class="row">
                        <div class="col-xs-6 col-md-3">
                            <label class="control-label" for="scheduleName">@lang('strings.name') <span class="field-optional"></span></label>
                            <div>
                                <input type="text" name="name" class="form-control" id="scheduleName" value="{{ old('name', $schedule->name) }}" />
                            </div><br>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-6 col-md-3">
                            <div class="form-group">
                                <label for="scheduleDayOfWeek" class="control-label">@lang('server.schedule.day_of_week')</label>
                                <div>
                                    <select data-action="update-field" data-field="cron_day_of_week" class="form-control" multiple>
                                        <option value="0">Zondag</option>
                                        <option value="1">Maandag</option>
                                        <option value="2">Dinsdag</option>
                                        <option value="3">Woensdag</option>
                                        <option value="4">Donderdag</option>
                                        <option value="5">Vrijdag</option>
                                        <option value="6">Zaterdag</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" id="scheduleDayOfWeek" class="form-control" name="cron_day_of_week" value="{{ old('cron_day_of_week', $schedule->cron_day_of_week) }}" />
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-3">
                            <div class="form-group">
                                <label for="scheduleDayOfMonth" class="control-label">@lang('server.schedule.day_of_month')</label>
                                <div>
                                    <select data-action="update-field" data-field="cron_day_of_month" class="form-control" multiple>
                                        @foreach(range(1, 31) as $i)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" id="scheduleDayOfMonth" class="form-control" name="cron_day_of_month" value="{{ old('cron_day_of_month', $schedule->cron_day_of_month) }}" />
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-3">
                            <div class="form-group col-md-12">
                                <label for="scheduleHour" class="control-label">@lang('server.schedule.hour')</label>
                                <div>
                                    <select data-action="update-field" data-field="cron_hour" class="form-control" multiple>
                                        @foreach(range(0, 23) as $i)
                                            <option value="{{ $i }}">{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}:00</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group col-md-12">
                                <input type="text" id="scheduleHour" class="form-control" name="cron_hour" value="{{ old('cron_hour', $schedule->cron_hour) }}" />
                            </div>
                        </div>
                        <div class="col-xs-6 col-md-3">
                            <div class="form-group">
                                <label for="scheduleMinute" class="control-label">@lang('server.schedule.minute')</label>
                                <div>
                                    <select data-action="update-field" data-field="cron_minute" class="form-control" multiple>
                                        @foreach(range(0, 55) as $i)
                                            @if($i % 5 === 0)
                                                <option value="{{ $i }}">_ _:{{ str_pad($i, 2, '0', STR_PAD_LEFT) }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <input type="text" id="scheduleMinute" class="form-control" name="cron_minute" value="{{ old('cron_minute', $schedule->cron_minute) }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

                @include('partials.schedules.task-template')
                    <div class="pull-right">
                        {!! csrf_field() !!}
                        <button type="submit" class="btn btn-sm btn-success" name="_method" value="PATCH">Taak opslaan</button>
                    </div>
    </div>
</form>
@endsection

@section('footer-scripts')
    @parent
    {!! Theme::js('js/frontend/server.socket.js') !!}
    {!! Theme::js('vendor/select2/select2.full.min.js') !!}
    {!! Theme::js('js/frontend/tasks/view-actions.js') !!}
    <script>
        $(document).ready(function () {
            $('#deleteButton').on('mouseenter', function () {
                $(this).find('i').html(' @lang('server.schedule.manage.delete')');
            }).on('mouseleave', function () {
                $(this).find('i').html('');
            });
            $.each(Pterodactyl.tasks, function (index, value) {
                var element = (index !== 0) ? $('button[data-action="add-new-task"]').trigger('click').data('element') : $('div[data-target="task-clone"]');
                var timeValue = (value.time_offset > 59) ? value.time_offset / 60 : value.time_offset;
                var timeInterval = (value.time_offset > 59) ? 'm' : 's';
                element.find('select[name="tasks[time_value][]"]').val(timeValue).trigger('change');
                element.find('select[name="tasks[time_interval][]"]').val(timeInterval).trigger('change');
                element.find('select[name="tasks[action][]"]').val(value.action).trigger('change');
                element.find('input[name="tasks[payload][]"]').val(value.payload);
            });
        });
    </script>
@endsection
