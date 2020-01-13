@section('tasks::chain-template')
					<div class="row">
						<div class="col-xl-12">
							<div class="card flex-fill w-100">
								<div class="card-header">
									<h5 class="card-title mb-0">Taken</h5>
								</div>
								<div class="card-body py-3">
                    <div class="row">
                        <div class="col-xs-6 col-md-10">
                            <label class="control-label" for="scheduleName">Na <span class="field-optional"></span></label>
                            <div>
                    <select name="tasks[time_value][]" class="form-control">
                        @foreach(range(0, 59) as $number)
                            <option value="{{ $number }}">{{ $number }}</option>
                        @endforeach
                    </select>
                            </div><br>
                        </div>
                        <div class="col-xs-6 col-md-2">
                            <label class="control-label" for="scheduleName">Tijd<span class="field-optional"></span></label>
                            <div>
                    <select name="tasks[time_interval][]" class="form-control">
                        <option value="s">Seconden</option>
                        <option value="m">Minuten</option>
                    </select>
                            </div><br>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-6 col-md-8">
                            <label class="control-label" for="scheduleName">Command <span class="field-optional"></span></label>
                            <div>
<input type="text" name="tasks[payload][]" class="form-control">
                            </div><br>
                        </div>
                        <div class="col-xs-6 col-md-4">
                            <label class="control-label" for="scheduleName">Actie<span class="field-optional"></span></label>
                            <div>
                <select name="tasks[action][]" class="form-control">
                    <option value="command">@lang('server.schedule.actions.command')</option>
                    <option value="power">@lang('server.schedule.actions.power')</option>
                </select>
                            </div><br>
@show
