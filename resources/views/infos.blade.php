@extends('layouts.app')

@section("othercss")
    <link rel="stylesheet" href="{{ asset('css/jquery-ui.min.css') }}">
@endsection

@section('content')
    @include('search')
    <div class="ui container segment grey stacked grid">
        <div class="row">
            <div class="four wide computer sixteen wide mobile column">
                @include('settings_divided_list')
            </div>
            <div class="twelve wide computer sixteen wide mobile column">
                <div class="ui icon message">
                    <i class="info icon"></i>
                    <div class="content">
                        <p>{{ __('commons.shared_info_msg') }}</p>
                    </div>
                </div>
                <h3 class="ui top attached inverted header">{{ __('commons.personal_info') }}</h3>
                <form action="/personal_info" method="POST" class="ui attached segment form" id="personal_info">
                    @csrf
                    <div class="ui grid">
                        <div class="row">
                            <div class="eight wide computer sixteen wide mobile column">
                                <div class="field">
                                    <label for="nationality">{{ __('commons.nationality') }}</label>
                                    <select multiple="" class="ui search dropdown" id="nationality" name="nationality">
                                        <option value="">{{ __('commons.country') }}
                                            (leri) {{ __('commons.select') }}</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="field">
                                    <label for="born_country">{{ __('commons.birth_country') }}</label>
                                    <select class="ui search dropdown" id="born_country">
                                        <option value="">{{ __('commons.country') }} {{ __('commons.select') }}</option>
                                        @foreach($countries as $country)
                                            <option value="{{ $country->id }}">{{ $country->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="field">
                                    <label for="birth_date">{{ __('commons.birth_date') }}</label>
                                    <input type="text" id="birth_date" name="birth_date">
                                    <input type="hidden" id="formatted_birth_date">
                                </div>
                                <div class="field">
                                    <label for="licence">{{ __('commons.licence') }}</label>
                                    <select multiple="" class="ui search dropdown" id="licence">
                                        <option value="">{{ __('commons.select') }}</option>
                                        <option value="M">M</option>
                                        <option value="A1">A1</option>
                                        <option value="A2">A2</option>
                                        <option value="A">A</option>
                                        <option value="B1">B1</option>
                                        <option value="B">B</option>
                                        <option value="BE">BE</option>
                                        <option value="C1">C1</option>
                                        <option value="C1E">C1E</option>
                                        <option value="C">C</option>
                                        <option value="CE">CE</option>
                                        <option value="D1">D1</option>
                                        <option value="D1E">D1E</option>
                                        <option value="D">D</option>
                                        <option value="DE">DE</option>
                                        <option value="F">F</option>
                                        <option value="G">G</option>
                                    </select>
                                </div>
                            </div>
                            <div class="eight wide computer sixteen wide mobile column">
                                <div class="field">
                                    <label for="military_status">{{ __('commons.military_status') }}</label>
                                    <select class="ui search dropdown" id="military_status">
                                        <option value="">{{ __('commons.select') }}</option>
                                        <option value="done">{{ __('commons.done') }}</option>
                                        <option value="doing">{{ __('commons.doing') }}</option>
                                        <option value="not_done">{{ __('commons.not_done') }}</option>
                                        <option value="postponed">{{ __('commons.postponed') }}</option>
                                        <option value="exempt">{{ __('commons.exempt') }}</option>
                                    </select>
                                </div>
                               <div class="field" id="postponed_date_field"
                                       @if (Auth::user()->military_status != "postponed") style="display: none;" @endif>
                                    <label for="postpone_date">{{ __('commons.postponed_date') }}</label>
                                    <input type="text" id="postpone_date" name="postpone_date">
                                    <input type="hidden" id="formatted_postpone_date">
                                </div>
                                <div class="field" id="discharge_date_field"
                                     @if (Auth::user()->military_status != "done") style="display: none;" @endif>
                                    <label for="discharge_date">{{ __('commons.discharge_date') }}</label>
                                    <input type="text" id="discharge_date" name="discharge_date">
                                    <input type="hidden" id="formatted_discharge_date">
                                </div>
                                <div class="field" id="exempt_reason_field"
                                     @if (Auth::user()->military_status != "exempt") style="display: none;" @endif>
                                    <label for="exempt_reason">{{ __('commons.exempt_reason') }}</label>
                                    <input type="text" id="exempt_reason" name="exempt_reason" value="{{ Auth::user()->military_exempt_reason }}">
                                </div>
                                <div class="grouped fields">
                                    <label for="gender">{{ __('commons.gender') }}</label>
                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="gender"
                                                   {{ Auth::user()->gender == "male" ? "checked=checked" : "" }} value="male"
                                                   tabindex="0" class="hidden">
                                            <label>{{ __('commons.male') }}</label>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="gender"
                                                   {{ Auth::user()->gender == "female" ? "checked=checked" : "" }}
                                                   value="female" tabindex="0" class="hidden">
                                            <label>{{ __('commons.female') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="grouped fields">
                                    <label for="marital_status">{{ __('commons.marital_status') }}</label>
                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="marital_status" value="single"
                                                   {{ Auth::user()->marital_status == "single" ? "checked=checked" : "" }} tabindex="0"
                                                   class="hidden">
                                            <label>{{ __('commons.single') }}</label>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="marital_status" tabindex="0"
                                                   {{ Auth::user()->marital_status == "married" ? "checked=checked" : "" }} value="married"
                                                   class="hidden">
                                            <label>{{ __('commons.married') }}</label>
                                        </div>
                                    </div>
                                    <div class="field">
                                        <div class="ui radio checkbox">
                                            <input type="radio" name="marital_status" tabindex="0"
                                                   {{ Auth::user()->marital_status == "not_specified" ? "checked=checked" : "" }} value="not_specified"
                                                   class="hidden">
                                            <label>{{ __('commons.not_specified') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="column">
                                <button type="submit" id="update_personals"
                                        class="fluid ui teal button">{{ __('commons.save') }}</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("otherscripts")
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script>
        $(function () {
            let user_birth_date = "{{ Auth::user()->birth_date }}";
            let user_military_postpone_date = "{{ Auth::user()->military_postpone_date }}";
            let user_military_discharge_date = "{{ Auth::user()->military_discharge_date }}";

            $("#military_status, #licence, #born_country, #nationality").dropdown();

            let datepicker_opts = {
                changeMonth: true,
                changeYear: true,
                dateFormat: 'dd.mm.yy',
                firstDay: 1,
                yearRange: 'c-70:c+10'
            };

            $("#birth_date").datepicker(
                $.extend({
                    altField: "#formatted_birth_date",
                    altFormat: "yy-mm-dd"
                }, datepicker_opts)

            );

            if (user_birth_date != "")
                $("#birth_date").datepicker("setDate", new Date("{{ Auth::user()->birth_date }}"));

            $("#postpone_date").datepicker(
                $.extend({
                    altField: "#formatted_postpone_date",
                    altFormat: "yy-mm-dd",
                    minDate: "today"
                }, datepicker_opts)
            );

            if (user_military_postpone_date != "")
                $("#postpone_date").datepicker("setDate", new Date("{{ Auth::user()->military_postpone_date }}"));

            $("#discharge_date").datepicker(
                $.extend({
                altField: "#formatted_discharge_date",
                altFormat: "yy-mm-dd"
                }, datepicker_opts)
            );

            if (user_military_discharge_date != "")
                $("#discharge_date").datepicker("setDate", new Date("{{ Auth::user()->military_discharge_date }}"));

            let user_nationalities = "{{ Auth::user()->nationalities }}".split(",");
            $("#nationality").dropdown('set selected', user_nationalities);
            let user_licences = "{{ Auth::user()->licence }}".split(",");
            $("#licence").dropdown('set selected', user_licences);
            $("#military_status").dropdown('set selected', "{{ Auth::user()->military_status }}");
            $("#born_country").dropdown('set selected', "{{ Auth::user()->born_country_id }}");

            $("#personal_info").submit(function (e) {
                e.preventDefault();
                let nationatilies = $("#nationality").dropdown('get value').toString();
                let born_country_id = $("#born_country").dropdown('get value').toString();
                let gender = $("[name='gender']:checked").val() != undefined ? $("[name='gender']:checked").val() : null;
                let marital_status = $("[name='marital_status']:checked").val() != undefined ? $("[name='marital_status']:checked").val() : null;
                let licence = $("#licence").dropdown('get value').toString();
                let birth_date = $("#formatted_birth_date").val();
                let military_status = $("#military_status").dropdown('get value').toString();
                let postpone_date = $("#formatted_postpone_date").val() != undefined ? $("#formatted_postpone_date").val() : null;
                let discharge_date = $("#formatted_discharge_date").val() != undefined ? $("#formatted_discharge_date").val() : null;
                let exempt_reason = $("#exempt_reason").val();
                $("#update_personals").addClass("loading");
                $.post("/personal_info", {
                    nationality: nationatilies,
                    born_country_id: born_country_id,
                    gender: gender,
                    marital_status: marital_status,
                    licence: licence,
                    birth_date: birth_date,
                    military_status: military_status,
                    postpone_date: postpone_date,
                    discharge_date: discharge_date,
                    exempt_reason: exempt_reason,
                    _token: '{{csrf_token()}}'
                }, function (data) {
                    if (data == 1) {
                        $(".ui.icon.message").after("<div class='ui success message'><i class='close icon'></i>{{ __('commons.personal_infos_updated') }}");
                        $("#update_personals").removeClass("loading");
                    }
                });
            });

            $("#military_status").change(function () {
                let status = $(this).val();
                console.log(status);
                if (status === 'postponed')
                    $("#postponed_date_field").show();
                else
                    $("#postponed_date_field").hide();

                if (status === 'done')
                    $("#discharge_date_field").show();
                else
                    $("#discharge_date_field").hide();

                if (status === 'exempt')
                    $("#exempt_reason_field").show();
                else
                    $("#exempt_reason_field").hide();
            });
        });
    </script>
@endsection