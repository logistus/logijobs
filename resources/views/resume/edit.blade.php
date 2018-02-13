@extends('layouts.app')

@section("othercss")
@endsection

@section('content')
@include('search')
<div class="ui container segment grid">
    <div class="row">
        <div class="column">
            <div class="ui blue big ribbon label">{{ __('commons.resume') }} {{ __('commons.edit') }}</div>
            <p style="text-align: right;"><a href="/resumes" class="ui green button">{{ __('commons.list_resumes') }}</a></p>
            @if($resume)<h2>{{ $resume->name }}</h2>@endif
        </div>
    </div>
    <div class="row">
        @if($resume)
        <div class="three wide computer sixteen wide mobile column">
            <div class="ui vertical fluid menu">
                <a class="item">
                    {{ __('commons.privacy') }}
                </a>
                <a class="item">
                    {{ __('commons.contact') }}
                </a>
                <a class="item">
                    {{ __('commons.personal') }}
                </a>
                <a class="item">
                    {{ __('commons.education') }}
                </a>
                <a class="item">
                    {{ __('commons.references') }}
                </a>
                <a class="item">
                    {{ __('commons.experiences') }}
                </a>
                <a class="item">
                    {{ __('commons.skills') }}
                </a>
            </div>
        </div>
        @endif
        <div class="thirteen wide computer sixteen wide mobile column">
            @if($resume)
            <div class="resume_sections" id="{{ __('commons.privacy') }}" style="display: none;">
                <h3>{{ __('commons.privacy') }}</h3>
                <div class="ui form">
                    <div class="grouped fields">
                        <label for="privacy">{{ __('commons.select_resume_privacy_option') }}:</label>
                        <div class="field">
                            <div class="ui radio checkbox">
                                <input type="radio" name="privacy" value="only_applied" {{ $resume->privacy == 'only_applied' ? 'checked=""' : "" }} tabindex="0" class="hidden">
                                <label>{{ ucfirst(__('commons.only')) }} {{ __('commons.applied') }} {{ __('commons.companies') }}</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui radio checkbox">
                                <input type="radio" name="privacy" value="applied_and_others" {{ $resume->privacy == 'applied_and_others' ? 'checked=""' : "" }} tabindex="0" class="hidden">
                                <label>{{ ucfirst(__('commons.applied')) }} {{ __('commons.companies') }} {{ __('commons.and') }} {{ __('commons.all') }} {{ config('app.name', 'Logi Jobs') }} {{ __('commons.companies') }}ı</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui radio checkbox">
                                <input type="radio" name="privacy" value="everyone" {{ $resume->privacy == 'everyone' ? 'checked=""' : "" }} tabindex="0" class="hidden">
                                <label>{{ __('commons.everybody') }}</label>
                            </div>
                        </div>
                        <div class="field">
                            <button class="ui blue button" id="save_privacy">{{ __('commons.save') }}</button>
                            <span id="privacy_saved" style="color: #0ea432; display: none;">{{ __('commons.saved') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            <div class="resume_sections" id="{{ __('commons.contact') }}" style="display: none;">
                <h3>{{ __('commons.contact') }}</h3>
                <div class="ui equal equal width form">
                    <div class="fields">
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
                    </div>
                    <div class="fields">
                        <div class="field">
                            <label for="mobile_phone">{{ __('commons.mobile') }} {{ __('commons.phone') }}</label>
                            <input type="text" id="mobile_phone" name="mobile_phone" maxlength="10"
                                   value="{{ $resume->contact_info ? $resume->contact_info->mobile_phone  : '' }}">
                        </div>
                        <div class="field">
                            <label for="home_phone">{{ __('commons.home') }} {{ __('commons.phone') }}</label>
                            <input type="text" id="home_phone" name="home_phone" maxlength="10"
                                   value="{{ $resume->contact_info ? $resume->contact_info->home_phone  : '' }}">
                        </div>
                    </div>
                    <div class="fields">
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
                    </div>
                    <div class="field">
                        <button class="ui blue button" id="save_contact">{{ __('commons.save') }}</button>
                        <span id="contact_saved" style="color: #0ea432; display: none;">{{ __('commons.saved') }}</span>
                    </div>
                </div>
            </div>
            @else
                <div class="ui container negative message">{{ __('commons.invalid_resume') }}</div>
            @endif
        </div>
    </div>
</div>
@endsection

@section("otherscripts")
<script>
    $(document).ready(function() {
        $(".ui.radio.checkbox").checkbox();
        var resume_id ="{{ $resume->id }}";
        var county_id = "{{ $resume->contact_info ? $resume->contact_info->county_id : '' }}";
        var selected_section = "{{ __('commons.privacy') }}";
        var county = $('#county');
        var city = $("#city");
        var menu_item = $(".ui.vertical.fluid.menu .item");

        menu_item.first().addClass("active");
        $("#"+selected_section).show();

        if (county_id) {
            county.parent('div').removeClass("disabled");
            $.get('/get_counties/'+city.val(), function(data){
                if (data) {
                    county.children('option').remove();
                    $.each(JSON.parse(data), function(i, item){
                        var html = '<option value="'+item.id+'"';
                        if (item.id == county_id) {
                            html += ' selected';
                        }
                        html += '>'+item.name+'</option>';
                        county.append(html);
                    });
                }
            });
        }

        menu_item.click(function(){
            $(".item").removeClass("active");
            $(this).addClass("active");
            selected_section = $(this).text().trim();
            $(".resume_sections").hide();
            $("#"+selected_section).show();
        });

        $("#save_privacy").click(function() {
            var selected_privacy = $("[name='privacy']:checked").val();
            $(this).addClass("loading");
            $("#privacy_saved").hide();
            $.post("/change_resume_privacy/"+resume_id, {selected: selected_privacy, _token: '{{csrf_token()}}'}, function(data) {
                if(data == 1) {
                    $("#save_privacy").removeClass("loading");
                    $("#privacy_saved").show();
                    setTimeout(function() {
                        $("#privacy_saved").hide();
                    },2000);
                } else {
                    alert("{{ __('commons.no_access_to_resume') }}");
                }
            });
        });

        $("#save_contact").click(function(){
           var city = $("#city").val();
           var county = $("#county").val();
           var home_phone = $("#home_phone").val();
           var mobile_phone = $("#mobile_phone").val();
           var email = $("#email").val();
           var personal_web = $('#personal_web').val();
           $(this).addClass("loading");
           $("#contact_saved").hide();
           $.post("/change_resume_contact/"+resume_id,
               {city_id: city, county_id: county, home_phone: home_phone, mobile_phone: mobile_phone,
                   email: email, personal_web: personal_web, _token: '{{csrf_token()}}'}, function(data){
                    if (data == 1) {
                        $("#save_contact").removeClass("loading");
                        $("#contact_saved").show();
                        setTimeout(function() {
                            $("#contact_saved").hide();
                        }, 2000);
                    } else {
                        alert("{{ __('commons.no_access_to_resume') }}");
                    }
               });
        });

        city.change(function(){
           var selected_city = $(this).val();
           county.parent('div').addClass("loading");
           //$("#home_phone").val($(this).attr('name'));
           $.get('/get_counties/'+selected_city, function(data){
              if (data) {
                  county.parent('div').removeClass("disabled");
                  county.parent('div').removeClass("loading");
                  county.children('option').remove();
                  $.each(JSON.parse(data), function(i, item){
                     county.append('<option value="'+item.id+'">'+item.name+'</option>');
                  });
              }
           });
        });
    });
</script>
@endsection

