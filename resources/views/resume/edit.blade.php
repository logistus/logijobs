@extends('layouts.app')

@section("othercss")
@endsection

@section('content')
    @include('search')
    <div class="ui container segment grid">
        <div class="row">
            <div class="column">
                <div class="ui blue big ribbon label">{{ __('commons.resume') }} {{ __('commons.edit') }}</div>
                <p style="text-align: right;"><a href="/resume"
                                                 class="ui green button">{{ __('commons.list_resumes') }}</a></p>
                <h2>{{ $resume->name }}</h2>
            </div>
        </div>
        <div class="row">
            <div class="three wide computer sixteen wide mobile column">
                photo field
            </div>
            <div class="eight wide computer sixteen wide mobile column">
                <h3 class="ui top attached inverted header">{{ __('commons.contact') }}</h3>
                <form class="ui attached segment form" id="contact_form">
                    <div class="field">
                        <label for="city">{{ __('commons.city') }}</label>
                        <select class="ui search selection dropdown" id="city">
                            <option value="">{{ __('commons.city') }} {{ __('commons.select') }}</option>
                            @foreach($cities as $city)
                                <option value="{{ $city->id }}"
                                        {{ $resume->contact_info && $resume->contact_info->city_id == $city->id ? 'selected' : '' }}>{{ $city->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <label for="county">{{ __('commons.county') }}</label>
                        <select class="ui search selection dropdown" id="county">
                            <option value="">{{ __('commons.county') }} {{ __('commons.select') }}</option>
                        </select>
                    </div>
                    <div class="field">
                        <label for="mobile_phone">{{ __('commons.mobile') }} {{ __('commons.phone') }}</label>
                        <input type="text" id="mobile_phone" name="mobile_phone"
                               value="{{ $resume->contact_info ? $resume->contact_info->mobile_phone  : '' }}">
                    </div>
                    <div class="field">
                        <label for="home_phone">{{ __('commons.home') }} {{ __('commons.phone') }}</label>
                        <input type="text" id="home_phone" name="home_phone"
                               value="{{ $resume->contact_info ? $resume->contact_info->home_phone  : '' }}">
                    </div>
                    <div class="field">
                        <label for="email">{{ __('commons.email') }}</label>
                        <input type="email" id="email" name="email"
                               value="{{ $resume->contact_info ? $resume->contact_info->email : '' }}">
                    </div>
                    <div class="field">
                        <label for="personal_web">{{ __('commons.personal_web_page') }}</label>
                        <input type="url" id="personal_web" name="personal_web"
                               value="{{ $resume->contact_info ? $resume->contact_info->personal_web  : '' }}">
                    </div>
                    <div class="field">
                        <button class="ui fluid blue button" id="save_contact"
                                type="submit">{{ __('commons.save') }}</button>
                    </div>
                </form>
            </div>
            <div class="five wide computer sixteen wide mobile column">
                <h3 class="ui top attached inverted header">{{ __('commons.privacy') }}</h3>
                <form class="ui attached segment form" id="privacy_form">
                    <div class="grouped fields">
                        <label for="privacy">{{ __('commons.select_resume_privacy_option') }}:</label>
                        <div class="field">
                            <div class="ui radio checkbox">
                                <input type="radio" name="privacy" value="only_applied"
                                       {{ $resume->privacy == 'only_applied' ? 'checked=""' : "" }} tabindex="0"
                                       class="hidden">
                                <label>{{ ucfirst(__('commons.only')) }} {{ __('commons.applied') }} {{ __('commons.companies') }}</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui radio checkbox">
                                <input type="radio" name="privacy" value="applied_and_others"
                                       {{ $resume->privacy == 'applied_and_others' ? 'checked=""' : "" }} tabindex="0"
                                       class="hidden">
                                <label>{{ ucfirst(__('commons.applied')) }} {{ __('commons.companies') }}
                                    {{ __('commons.and') }} {{ __('commons.all') }} {{ config('app.name', 'Logi Jobs') }} {{ __('commons.companies') }}ı
                                </label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui radio checkbox">
                                <input type="radio" name="privacy" value="everyone"
                                       {{ $resume->privacy == 'everyone' ? 'checked=""' : "" }} tabindex="0"
                                       class="hidden">
                                <label>{{ __('commons.everybody') }}</label>
                            </div>
                        </div>
                        <div class="field">
                            <button class="ui fluid blue button" id="save_privacy">{{ __('commons.save') }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("otherscripts")
    <script>
        $(document).ready(function () {
            $("#home_phone").inputmask("(999) 999 99 99");
            $("#mobile_phone").inputmask("(999) 999 99 99");
            $(".ui.radio.checkbox").checkbox();
            let resume_id = "{{ $resume->id }}";
            let county_id = "{{ $resume->contact_info ? $resume->contact_info->county_id : '' }}";
            let county = $('#county');
            let city = $("#city");
            $("#city, #county").dropdown();

            if (county_id) {
                county.parent('div').removeClass("disabled");
                $.get('/get_counties/' + city.val(), function (data) {
                    if (data) {
                        county.children('option').remove();
                        $.each(JSON.parse(data), function (i, item) {
                            var html = '<option value="' + item.id + '"';
                            if (item.id == county_id) {
                                html += ' selected';
                            }
                            html += '>' + item.name + '</option>';
                            county.append(html);
                        });
                    }
                });
            }

            $("#privacy_form").submit(function (e) {
                e.preventDefault();
                let selected_privacy = $("[name='privacy']:checked").val();
                $("#save_privacy").addClass("loading");
                $.ajax({
                    url: "/resume/" + resume_id + "/update/privacy",
                    type: "patch",
                    data: {selected: selected_privacy, _token: '{{csrf_token()}}'},
                    success: function (data) {
                        if (data == 1) {
                            $("#save_privacy").removeClass("loading");
                        } else {
                            alert("{{ __('commons.no_access_to_resume') }}");
                        }
                    }
                });
            });

            $("#contact_form").form({
                fields: {
                    mobile_phone: {
                        optional: true,
                        rules: [
                            {
                                type: 'doesntContain[_]',
                                prompt: 'Invalid number'
                            }
                        ]
                    },
                    home_phone: {
                        optional: true,
                        rules: [
                            {
                                type: 'doesntContain[_]',
                                prompt: 'Invalid number'
                            }
                        ]
                    },
                    personal_web: {
                        optional: true,
                        rules: [
                            {
                                type: 'url',
                                prompt: 'Enter valid URL.'
                            }
                        ]
                    },
                    email: {
                        optional: true,
                        rules: [
                            {
                                type: 'email',
                                prompt: 'Enter valid email.'
                            }
                        ]
                    },
                },
                inline: true
            });

            $("#contact_form").submit(function (e) {
                e.preventDefault();
                let city = $("#city").val();
                let county = $("#county").val();
                let home_phone = $("#home_phone").val();
                let mobile_phone = $("#mobile_phone").val();
                let email = $("#email").val();
                let personal_web = $('#personal_web').val();

                if ($('#contact_form').form('is valid')) {
                    $("#save_contact").addClass("loading");
                    $.post("/change_resume_contact/" + resume_id,
                        {
                            city_id: city, county_id: county, home_phone: home_phone, mobile_phone: mobile_phone,
                            email: email, personal_web: personal_web, _token: '{{csrf_token()}}'
                        }, function (data) {
                            if (data == 1) {
                                $("#save_contact").removeClass("loading");
                            } else {
                                alert("{{ __('commons.no_access_to_resume') }}");
                            }
                        });
                }
            });

            city.change(function () {
                var selected_city = $(this).val();
                county.parent('div').addClass("loading");
                $.get('/get_counties/' + selected_city, function (data) {
                    if (data) {
                        county.parent('div').removeClass("disabled");
                        county.parent('div').removeClass("loading");
                        county.children('option').remove();
                        $.each(JSON.parse(data), function (i, item) {
                            county.append('<option value="' + item.id + '">' + item.name + '</option>');
                        });
                    }
                });
            });
        });
    </script>
@endsection

