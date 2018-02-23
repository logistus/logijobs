@extends('layouts.app')

@section("othercss")
@endsection

@section('content')
    @include('search')
    <div class="ui container segment grey grid">
        <div class="row">
            <div class="column">
                <div class="ui blue big ribbon label"
                     id="resume_edit_ribbon">{{ __('commons.resume') }} {{ __('commons.edit') }}</div>
            </div>
        </div>
        <div class="row">
            <div class="column">
                <div><a href="/resume" class="ui green button">{{ __('commons.list_resumes') }}</a></div>
            </div>
        </div>
        <h2>{{ $resume->name }}</h2>
        <div class="row">
            <div class="three wide computer sixteen wide mobile column">
                photo field
            </div>
            <div class="eight wide computer sixteen wide mobile column">
                <h3 class="ui top attached inverted header">{{ __('commons.contact_info') }}</h3>
                <form class="ui attached segment form" id="contact_form" style="margin-bottom: 15px;">
                    @csrf
                    <div class="required field">
                        <label for="county">{{ __('commons.country') }}</label>
                        <select class="ui search selection dropdown" id="country">
                            <option value="select">{{ __('commons.country') }} {{ __('commons.select') }}</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}"
                                        {{ $resume->contact_info && $resume->contact_info->country_id == $country->id ? 'selected' : '' }}>{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="required field">
                        <label for="city">{{ __('commons.city') }}</label>
                        <select class="ui search selection dropdown" id="city">
                            <option value="select">{{ __('commons.city') }} {{ __('commons.select') }}</option>
                        </select>
                    </div>
                    <div class="required field">
                        <label for="county">{{ __('commons.county') }}</label>
                        <select class="ui search selection dropdown" id="county">
                            <option value="select">{{ __('commons.county') }} {{ __('commons.select') }}</option>
                        </select>
                    </div>
                    <div class="required field">
                        <label for="mobile_phone">{{ __('commons.mobile') }} {{ __('commons.phone') }}</label>
                        <input type="text" id="mobile_phone" name="mobile_phone"
                               value="{{ $resume->contact_info ? $resume->contact_info->mobile_phone  : '' }}">
                    </div>
                    <div class="field">
                        <label for="home_phone">{{ __('commons.home') }} {{ __('commons.phone') }}</label>
                        <input type="text" id="home_phone" name="home_phone"
                               value="{{ $resume->contact_info ? $resume->contact_info->home_phone  : '' }}">
                    </div>
                    <div class="required field">
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
                <h3 class="ui top attached inverted header"
                    style="margin-top: 0;">{{ __('commons.work_experiences') }}</h3>
                <form class="ui attached segment form" id="work_experiences_form" style="margin-bottom: 15px;">
                    <div class="ui grid">
                        <div class="row">
                            <div class="column">
                                <button type="button" class="ui right floated green button" id="btn-add-experience">
                                    {{ __('commons.add_experience') }}
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div id="experiences" class="column">
                                @include('resume.experiences')
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="five wide computer sixteen wide mobile column">
                <h3 class="ui top attached inverted header">{{ __('commons.privacy_option') }}</h3>
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
                                    {{ __('commons.and') }} {{ __('commons.all') }} {{ config('app.name', 'Logi Jobs') }} {{ __('commons.companies') }}
                                    ı
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
    <!-- add experience modal -->
    <div class="ui small modal add-experience">
        <div class="header">{{ __('commons.add_experience') }}</div>
        <div class="description">
            <form class="ui form" style="padding: 10px 10px 0 10px;" id="add-experience-form">
                @csrf
                <div class="two fields">
                    <div class="required field">
                        <label for="job_title">{{ __('commons.job_title') }}</label>
                        <input type="text" name="job_title" id="job_title">
                    </div>
                    <div class="required field">
                        <label for="company_name">{{ __('commons.company_name') }}</label>
                        <input type="text" name="company_name" id="company_name">
                    </div>
                </div>
                <div class="field">
                    <label for="job_description">{{ __('commons.job_description') }}</label>
                    <textarea name="job_description" id="job_description" cols="30" rows="5"></textarea>
                </div>
                <div class="fields">
                    <div class="seven wide required field">
                        <label>{{ __('commons.start_date') }}</label>
                        <div class="equal width fields">
                            <div class="field">
                                <select class="ui search compact selection dropdown" id="start_date_month">
                                    <option value="select">{{ __('commons.month') }}</option>
                                    <option value="1">{{ __('commons.january') }}</option>
                                    <option value="2">{{ __('commons.february') }}</option>
                                    <option value="3">{{ __('commons.march') }}</option>
                                    <option value="4">{{ __('commons.april') }}</option>
                                    <option value="5">{{ __('commons.may') }}</option>
                                    <option value="6">{{ __('commons.june') }}</option>
                                    <option value="7">{{ __('commons.july') }}</option>
                                    <option value="8">{{ __('commons.august') }}</option>
                                    <option value="9">{{ __('commons.september') }}</option>
                                    <option value="10">{{ __('commons.october') }}</option>
                                    <option value="11">{{ __('commons.november') }}</option>
                                    <option value="12">{{ __('commons.december') }}</option>
                                </select>
                            </div>
                            <div class="field">
                                <select class="ui search compact selection dropdown" id="start_date_year">
                                    <option value="select">{{ __('commons.year') }}</option>
                                    @for ($i = date("Y"); $i >= 1950; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="four wide field" style="line-height: 69px;">
                        <div class="ui toggle checkbox" id="still_working">
                            <input type="checkbox" name="still_working">
                            <label for="still_working">{{ __('commons.still_working') }}</label>
                        </div>
                    </div>
                    <div class="seven wide field" id="end_date_field">
                        <label>{{ __('commons.end_date') }}</label>
                        <div class="equal width fields">
                            <div class="field">
                                <select class="ui search compact selection dropdown" id="end_date_month">
                                    <option value="select">{{ __('commons.month') }}</option>
                                    <option value="1">{{ __('commons.january') }}</option>
                                    <option value="2">{{ __('commons.february') }}</option>
                                    <option value="3">{{ __('commons.march') }}</option>
                                    <option value="4">{{ __('commons.april') }}</option>
                                    <option value="5">{{ __('commons.may') }}</option>
                                    <option value="6">{{ __('commons.june') }}</option>
                                    <option value="7">{{ __('commons.july') }}</option>
                                    <option value="8">{{ __('commons.august') }}</option>
                                    <option value="9">{{ __('commons.september') }}</option>
                                    <option value="10">{{ __('commons.october') }}</option>
                                    <option value="11">{{ __('commons.november') }}</option>
                                    <option value="12">{{ __('commons.december') }}</option>
                                </select>
                            </div>
                            <div class="field">
                                <select class="ui search compact selection dropdown" id="end_date_year">
                                    <option value="select">{{ __('commons.year') }}</option>
                                    @for ($i = date("Y"); $i >= 1950; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="equal width fields">
                    <div class="required field">
                        <label for="job_country">{{ __('commons.country') }}</label>
                        <select class="ui search selection dropdown" id="job_country">
                            <option value="select">{{ __('commons.country') }}</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="required field">
                        <label for="job_city">{{ __('commons.city') }}</label>
                        <select class="ui search selection dropdown" id="job_city">
                            <option value="select">{{ __('commons.city') }}</option>
                        </select>
                    </div>
                    <div class="required field">
                        <label for="work_type">{{ __('commons.work_type') }}</label>
                        <select class="ui search selection dropdown" id="work_type">
                            <option value="select">{{ __('commons.work_type') }}</option>
                            @foreach($work_types as $work_type)
                                <option value="{{ $work_type->id }}">{{ $work_type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="actions">
            <button type="button" class="ui negative button">{{ __('commons.cancel') }}</button>
            <button type="submit" class="ui positive button" id="add-experience">{{ __('commons.add') }}</button>
        </div>
    </div>
    <!-- confirm delete experience modal -->
    <div class="ui mini modal confirm-delete-experience">
        <div class="header">{{ __('commons.experience') }} {{ __('commons.delete') }}</div>
        <div class="content">
            <p>{{ __('commons.are_you_sure') }}?</p>
        </div>
        <div class="actions">
            <div href="#" class="ui negative button">{{ __('commons.no') }}</div>
            <div href="#" class="ui positive button btn-delete-experience">{{ __('commons.yes') }}</div>
        </div>
    </div>
    <!-- edit experience modal -->
    <div class="ui small modal edit-experience">
        <div class="header">{{ __('commons.experience')." ".__('commons.edit') }}</div>
        <div class="description">
            <form class="ui form" style="padding: 10px 10px 0 10px;" id="edit-experience-form">
                @csrf
                <div class="two fields">
                    <div class="required field">
                        <label for="job_title_edit">{{ __('commons.job_title') }}</label>
                        <input type="text" name="job_title_edit" id="job_title_edit">
                    </div>
                    <div class="required field">
                        <label for="company_name_edit">{{ __('commons.company_name') }}</label>
                        <input type="text" name="company_name_edit" id="company_name_edit">
                    </div>
                </div>
                <div class="field">
                    <label for="job_description_edit">{{ __('commons.job_description') }}</label>
                    <textarea name="job_description_edit" id="job_description_edit" cols="30" rows="5"></textarea>
                </div>
                <div class="fields">
                    <div class="seven wide required field">
                        <label>{{ __('commons.start_date') }}</label>
                        <div class="equal width fields">
                            <div class="field">
                                <select class="ui search compact selection dropdown" id="start_date_month_edit">
                                    <option value="select">{{ __('commons.month') }}</option>
                                    <option value="1">{{ __('commons.january') }}</option>
                                    <option value="2">{{ __('commons.february') }}</option>
                                    <option value="3">{{ __('commons.march') }}</option>
                                    <option value="4">{{ __('commons.april') }}</option>
                                    <option value="5">{{ __('commons.may') }}</option>
                                    <option value="6">{{ __('commons.june') }}</option>
                                    <option value="7">{{ __('commons.july') }}</option>
                                    <option value="8">{{ __('commons.august') }}</option>
                                    <option value="9">{{ __('commons.september') }}</option>
                                    <option value="10">{{ __('commons.october') }}</option>
                                    <option value="11">{{ __('commons.november') }}</option>
                                    <option value="12">{{ __('commons.december') }}</option>
                                </select>
                            </div>
                            <div class="field">
                                <select class="ui search compact selection dropdown" id="start_date_year_edit">
                                    <option value="select">{{ __('commons.year') }}</option>
                                    @for ($i = date("Y"); $i >= 1950; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="four wide field" style="line-height: 69px;">
                        <div class="ui toggle checkbox" id="still_working_edit">
                            <input type="checkbox" name="still_working_edit">
                            <label for="still_working_edit">{{ __('commons.still_working') }}</label>
                        </div>
                    </div>
                    <div class="seven wide field" id="end_date_field_edit">
                        <label>{{ __('commons.end_date') }}</label>
                        <div class="equal width fields">
                            <div class="field">
                                <select class="ui search compact selection dropdown" id="end_date_month_edit">
                                    <option value="select">{{ __('commons.month') }}</option>
                                    <option value="1">{{ __('commons.january') }}</option>
                                    <option value="2">{{ __('commons.february') }}</option>
                                    <option value="3">{{ __('commons.march') }}</option>
                                    <option value="4">{{ __('commons.april') }}</option>
                                    <option value="5">{{ __('commons.may') }}</option>
                                    <option value="6">{{ __('commons.june') }}</option>
                                    <option value="7">{{ __('commons.july') }}</option>
                                    <option value="8">{{ __('commons.august') }}</option>
                                    <option value="9">{{ __('commons.september') }}</option>
                                    <option value="10">{{ __('commons.october') }}</option>
                                    <option value="11">{{ __('commons.november') }}</option>
                                    <option value="12">{{ __('commons.december') }}</option>
                                </select>
                            </div>
                            <div class="field">
                                <select class="ui search compact selection dropdown" id="end_date_year_edit">
                                    <option value="select">{{ __('commons.year') }}</option>
                                    @for ($i = date("Y"); $i >= 1950; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="equal width fields">
                    <div class="required field">
                        <label for="job_country_edit">{{ __('commons.country') }}</label>
                        <select class="ui search selection dropdown" id="job_country_edit">
                            <option value="select">{{ __('commons.country') }}</option>
                            @foreach($countries as $country)
                                <option value="{{ $country->id }}">{{ $country->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="required field">
                        <label for="job_city_edit">{{ __('commons.city') }}</label>
                        <select class="ui search selection dropdown" id="job_city_edit">
                            <option value="select">{{ __('commons.city') }}</option>
                        </select>
                    </div>
                    <div class="required field">
                        <label for="work_type_edit">{{ __('commons.work_type') }}</label>
                        <select class="ui search selection dropdown" id="work_type_edit">
                            <option value="select">{{ __('commons.work_type') }}</option>
                            @foreach($work_types as $work_type)
                                <option value="{{ $work_type->id }}">{{ $work_type->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>
        </div>
        <div class="actions">
            <button type="button" class="ui negative button">{{ __('commons.cancel') }}</button>
            <button type="submit" class="ui positive button"
                    name="edit-experience-btn">{{ __('commons.edit') }}</button>
        </div>
    </div>
@endsection

@section("otherscripts")
    <script>
        $(document).ready(function () {
            $("#home_phone").inputmask("(999) 999 99 99");
            $("#mobile_phone").inputmask("(999) 999 99 99");
            let resume_id = "{{ $resume->id }}";
            let country_id = "{{ $resume->contact_info ? $resume->contact_info->country_id : '' }}";
            let city_id = "{{ $resume->contact_info ? $resume->contact_info->city_id : '' }}";
            let county_id = "{{ $resume->contact_info ? $resume->contact_info->county_id : '' }}";
            let county = $('#county');
            let city = $("#city");
            let country = $("#country");
            $("#city, #county, #country, #end_date_month, #end_date_year, #start_date_month, #start_date_year, #job_country, #job_city, #work_type").dropdown();
            $("#city, #county, #job_city").parent("div").addClass("disabled");

            if (country_id > 0 && city_id > 0 && county_id > 0) {
                $("#city, #county").parent("div").addClass("loading");

                $.get('/get_cities/' + country_id, function (data) {
                    if (data) {
                        city.parent('div').removeClass('disabled');
                        city.children('option').remove();
                        city.append('<option value="select">{{ __("commons.city") }} {{ __("commons.select") }}</option>');
                        $.each(JSON.parse(data), function (i, item) {
                            if (item.id == city_id)
                                city.append('<option value="' + item.id + '" selected=selected>' + item.name + '</option>');
                            else
                                city.append('<option value="' + item.id + '">' + item.name + '</option>');
                        });
                        $("#city").parent("div").removeClass("loading");
                    }
                });

                $.get('/get_counties/' + city_id, function (data) {
                    if (data) {
                        county.parent('div').removeClass('disabled');
                        county.children('option').remove();
                        county.append('<option value="select">{{ __("commons.county") }} {{ __("commons.select") }}</option>');
                        $.each(JSON.parse(data), function (i, item) {
                            if (item.id == county_id)
                                county.append('<option value="' + item.id + '" selected=selected>' + item.name + '</option>');
                            else
                                county.append('<option value="' + item.id + '">' + item.name + '</option>');
                        });
                        $("#county").parent("div").removeClass("loading");
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
                        $("#save_privacy").removeClass("loading");
                        if (data == 1) {
                            $("#resume_edit_ribbon").after("<div class='ui success message'>" +
                                "<i class='close icon'></i>{{ __('commons.privacy_updated') }}</div>");
                        } else if (data == 2) {
                            return true;
                        } else {
                            $("#resume_edit_ribbon").after("<div class='ui error message'>" +
                                "<i class='close icon'></i>{{ __('commons.no_access_to_resume') }}</div>");
                        }
                    }
                });
            });

            $("#add-experience-form").form({
                fields: {
                    job_title: {
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'required'
                            }
                        ]
                    },
                    company_name: {
                        rules: [
                            {
                                type: 'empty',
                                prompt: 'required'
                            }
                        ]
                    },
                    start_date_month: {
                        rules: [
                            {
                                type: 'integer',
                                prompt: 'required'
                            }
                        ]
                    },
                    start_date_year: {
                        rules: [
                            {
                                type: 'integer',
                                prompt: 'required'
                            }
                        ]
                    },
                    job_country: {
                        rules: [
                            {
                                type: 'integer',
                                prompt: 'required'
                            }
                        ]
                    },
                    job_city: {
                        rules: [
                            {
                                type: 'integer',
                                prompt: 'required'
                            }
                        ]
                    },
                    work_type: {
                        rules: [
                            {
                                type: 'integer',
                                prompt: 'required'
                            }
                        ]
                    }
                }
            });

            $("#add-experience-form").submit(function (e) {
                e.preventDefault();
                let job_title = $("#job_title").val();
                let company_name = $("#company_name").val();
                let job_description = $("#job_description").val();
                let start_date = ('0' + $("#start_date_month").dropdown("get value")).slice(-2) + "." + $("#start_date_year").dropdown("get value");
                let still_working = $("#still_working").checkbox("is checked") ? 1 : 0;
                let end_date = !still_working ? ('0' + $("#end_date_month").dropdown("get value")).slice(-2) + "." + $("#end_date_year").dropdown("get value") : null;
                let job_country = $("#job_country").dropdown("get value");
                let job_city = $("#job_city").dropdown("get value");
                let work_type = $("#work_type").dropdown("get value");
                if (!still_working && end_date == null) {
                    alert("still work or end this pain");
                    return false;
                }
                if ($('#add-experience-form').form('is valid')) {
                    $("#add-experience").addClass("loading");
                    $.post("/resume_experience/" + resume_id, {
                        resume_id: resume_id,
                        job_title: job_title,
                        company_name: company_name,
                        job_description: job_description,
                        start_date: start_date,
                        still_working: still_working,
                        end_date: end_date,
                        job_country: job_country,
                        job_city: job_city,
                        work_type: work_type,
                        _token: '{{csrf_token()}}'
                    }, function (data) {
                        if (data == 1) {
                            $(".add-experience").modal('hide');
                            document.location.reload();
                        }
                    });
                }
            });

            $("#add-experience").click(function () {
                $("#add-experience-form").submit();
                return false;
            });

            $('#still_working').checkbox({
                onChecked: function () {
                    $("#end_date_field").css("visibility", "hidden");
                },
                onUnchecked: function () {
                    $("#end_date_field").css("visibility", "visible");
                }
            });

            $('#still_working_edit').checkbox({
                onChecked: function () {
                    $("#end_date_field_edit").css("visibility", "hidden");
                },
                onUnchecked: function () {
                    $("#end_date_field_edit").css("visibility", "visible");
                }
            });

            $("[name='delete-experience']").click(function (e) {
                e.preventDefault();
                $(".confirm-delete-experience").modal("show");
                $(".btn-delete-experience").attr("id", $(this).attr("id"));
            });

            $(".btn-delete-experience").click(function () {
                let experience_id = $(this).attr("id");
                $.get("/delete_experience/" + experience_id, function (data) {
                    if (data == 1) {
                        document.location.reload();
                    }
                });
            });

            $("[name='edit-experience']").click(function (e) {
                e.preventDefault();
                let experience_id = $(this).attr("id");
                $(".edit-experience").modal("show");
                $.get("/get_experience_details/" + experience_id, function (data) {
                    let experience_details = JSON.parse(data);
                    $("#job_title_edit").val(experience_details.job_title);
                    $("#company_name_edit").val(experience_details.company_name);
                    $("#job_description_edit").val(experience_details.job_description);
                    $("#start_date_month_edit").dropdown("set selected", parseInt(experience_details.start_date.split(".")[0], 10));
                    $("#start_date_year_edit").dropdown("set selected", experience_details.start_date.split(".")[1]);
                    if (experience_details.still_working > 0) {
                        $("#still_working_edit").checkbox("set checked");
                        $("#end_date_month_edit").dropdown();
                        $("#end_date_year_edit").dropdown();
                        $("div#end_date_field_edit.seven.wide.field").css("visibility", "hidden");
                    } else {
                        $("div#end_date_field_edit").css("visibility", "visible");
                        $("#still_working_edit").checkbox("set unchecked");
                        $("#end_date_month_edit").dropdown("set selected", parseInt(experience_details.end_date.split(".")[0], 10));
                        $("#end_date_year_edit").dropdown("set selected", experience_details.end_date.split(".")[1]);
                    }
                    let country_id = experience_details.country_id;
                    $("#job_country_edit").dropdown("set selected", country_id);
                    $.get('/get_cities/' + country_id, function (data) {
                        if (data) {
                            $("#job_city_edit").children('option').remove();
                            $("#job_city_edit").append('<option value="select">{{ __("commons.city") }} {{ __("commons.select") }}</option>');
                            $.each(JSON.parse(data), function (i, item) {
                                if (item.id == city_id)
                                    $("#job_city_edit").append('<option value="' + item.id + '" selected=selected>' + item.name + '</option>');
                                else
                                    $("#job_city_edit").append('<option value="' + item.id + '">' + item.name + '</option>');
                            });
                        }
                    });
                    $("#job_city_edit").dropdown();
                    $("#work_type_edit").dropdown("set selected", experience_details.work_type);
                    $("[name='edit-experience-btn']").attr("id", experience_details.id);
                });
            });

            $("[name='edit-experience-btn']").click(function () {
                let experience_id = $(this).attr("id");
                let start_date = ('0' + $("#start_date_month_edit").dropdown("get value")).slice(-2) + "." + $("#start_date_year_edit").dropdown("get value");
                let still_working = $("#still_working_edit").checkbox("is checked") ? 1 : 0;
                let end_date = !still_working ? ('0' + $("#end_date_month_edit").dropdown("get value")).slice(-2) + "." + $("#end_date_year_edit").dropdown("get value") : null;
                $.post("/edit_experience/" + experience_id, {
                    resume_id: resume_id,
                    job_title: $("#job_title_edit").val(),
                    company_name: $("#company_name_edit").val(),
                    job_description: $("#job_description_edit").val(),
                    start_date: start_date,
                    still_working: still_working,
                    end_date: end_date,
                    job_country: $("#job_country_edit").dropdown("get value"),
                    job_city: $("#job_city_edit").dropdown("get value"),
                    work_type: $("#work_type_edit").dropdown("get value"),
                    _token: '{{csrf_token()}}'
                }, function (data) {
                    if (data == 1)
                        document.location.reload();
                });
            });

            $("#contact_form").form({
                fields: {
                    country: {
                        rules: [
                            {
                                type: 'integer',
                                prompt: '{{ __("commons.country") }} {{ __("commons.select") }}'
                            }
                        ]
                    },
                    city: {
                        rules: [
                            {
                                type: 'integer',
                                prompt: '{{ __("commons.city") }} {{ __("commons.select") }}'
                            }
                        ]
                    },
                    county: {
                        rules: [
                            {
                                type: 'integer',
                                prompt: '{{ __("commons.county") }} {{ __("commons.select") }}'
                            }
                        ]
                    },
                    mobile_phone: {
                        rules: [
                            {
                                type: 'empty',
                                prompt: '{{ __("commons.mobile_phone_required") }}'
                            },
                            {
                                type: 'doesntContain[_]',
                                prompt: '{{ __("commons.invalid_number") }}'
                            }
                        ]
                    },
                    home_phone: {
                        optional: true,
                        rules: [
                            {
                                type: 'doesntContain[_]',
                                prompt: '{{ __("commons.invalid_number") }}'
                            }
                        ]
                    },
                    personal_web: {
                        optional: true,
                        rules: [
                            {
                                type: 'url',
                                prompt: '{{ __("commons.invalid_url") }}'
                            }
                        ]
                    },
                    email: {
                        rules: [
                            {
                                type: 'empty',
                                prompt: '{{ __("commons.email_required") }}'
                            },
                            {
                                type: 'email',
                                prompt: '{{ __("commons.invalid_email") }}'
                            }
                        ]
                    },
                },
                inline: true
            });

            $("#contact_form").submit(function (e) {
                e.preventDefault();
                let user_id = "{{ Auth::id() }}";
                let country = $("#country").dropdown("get value")
                let city = $("#city").dropdown("get value");
                let county = $("#county").dropdown("get value");
                let home_phone = $("#home_phone").val();
                let mobile_phone = $("#mobile_phone").val();
                let email = $("#email").val();
                let personal_web = $('#personal_web').val();

                if ($('#contact_form').form('is valid')) {
                    $("#save_contact").addClass("loading");
                    $.post("/resume_contact/" + resume_id,
                        {
                            user_id: user_id, country_id: country, city_id: city,
                            county_id: county, home_phone: home_phone, mobile_phone: mobile_phone, email: email,
                            personal_web: personal_web, _token: '{{csrf_token()}}'
                        }, function (data) {
                            $("#save_contact").removeClass("loading");
                            if (data == 1) {
                                $("#resume_edit_ribbon").after("<div class='ui success message'>" +
                                    "<i class='close icon'></i>{{ __('commons.contact_infos_updated') }}");
                            } else if (data == 2) {
                                return true;
                            } else if (data == 3) {
                                $("#resume_edit_ribbon").after("<div class='ui error message'>" +
                                    "<i class='close icon'></i>{{ __('commons.email_in_use') }}");
                            } else {
                                $("#resume_edit_ribbon").after("<div class='ui error message'>" +
                                    "<i class='close icon'></i>{{ __('commons.no_access_to_resume') }}");
                            }
                        });
                }
            });

            city.change(function () {
                var selected_city = $(this).dropdown("get value");
                county.parent('div').addClass("loading");
                if (selected_city != "select") {
                    $.get('/get_counties/' + selected_city, function (data) {
                        if (data) {
                            county.parent('div').removeClass("disabled");
                            county.parent('div').removeClass("loading");
                            county.children('option').remove();
                            county.append('<option value="select">{{ __("commons.county") }} {{ __("commons.select") }}</option>');
                            $.each(JSON.parse(data), function (i, item) {
                                county.append('<option value="' + item.id + '">' + item.name + '</option>');
                            });
                        }
                    });
                } else {
                    county.parent('div').addClass("disabled");
                    county.parent('div').removeClass("loading");
                }
            });

            country.change(function () {
                let selected_country = $(this).dropdown('get value');
                if (selected_country != "select") {
                    city.parent('div').addClass("loading");
                    $.get('/get_cities/' + selected_country, function (data) {
                        if (data) {
                            city.parent('div').removeClass("disabled");
                            city.parent('div').removeClass("loading");
                            city.children('option').remove();
                            city.append('<option value="select">{{ __("commons.city") }} {{ __("commons.select") }}</option>');
                            $.each(JSON.parse(data), function (i, item) {
                                city.append('<option value="' + item.id + '">' + item.name + '</option>');
                            });
                        }
                    });
                } else {
                    city.parent('div').addClass("disabled");
                    city.parent('div').removeClass("loading");
                }
            });

            $("#job_country").change(function () {
                let selected_country = $(this).dropdown('get value');
                if (selected_country != "select") {
                    $("#job_city").parent('div').addClass("loading");
                    $.get('/get_cities/' + selected_country, function (data) {
                        if (data) {
                            $("#job_city").parent('div').removeClass("disabled");
                            $("#job_city").parent('div').removeClass("loading");
                            $("#job_city").children('option').remove();
                            $("#job_city").append('<option value="select">{{ __("commons.city") }} {{ __("commons.select") }}</option>');
                            $.each(JSON.parse(data), function (i, item) {
                                $("#job_city").append('<option value="' + item.id + '">' + item.name + '</option>');
                            });
                        }
                    });
                } else {
                    $("#job_city").parent('div').addClass("disabled");
                    $("#job_city").parent('div').removeClass("loading");
                }
            });

            $("#btn-add-experience").click(function () {
                $(".add-experience").modal('show');
            });
        });
    </script>
@endsection

