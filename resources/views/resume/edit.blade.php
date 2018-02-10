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
            <h2>{{ $resume->name }}</h2>
        </div>
    </div>
    <div class="row">
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
        <div class="thirteen wide computer sixteen wide mobile column">
            <div class="resume_sections" id="{{ __('commons.privacy') }}" style="display: none;">
                <h3>{{ __('commons.privacy') }}</h5>
                <div class="ui form">
                    <div class="grouped fields">
                        <label for="privacy">{{ __('commons.select_resume_privacy_option') }}:</label>
                        <div class="field">
                            <div class="ui radio checkbox">
                                <input type="radio" name="privacy" tabindex="0" class="hidden">
                                <label>{{ ucfirst(__('commons.only')) }} {{ __('commons.applied') }} {{ __('commons.companies') }}</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui radio checkbox">
                                <input type="radio" name="privacy" checked="" tabindex="0" class="hidden">
                                <label>{{ ucfirst(__('commons.applied')) }} {{ __('commons.companies') }} {{ __('commons.and') }} {{ __('commons.all') }} {{ config('app.name', 'Logi Jobs') }} {{ __('commons.companies') }}ı</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui radio checkbox">
                                <input type="radio" name="privacy" tabindex="0" class="hidden">
                                <label>{{ __('commons.everybody') }}</label>
                            </div>
                        </div>
                        <div class="field">
                            <button class="ui blue button" id="save_privacy">{{ __('commons.save') }}</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="resume_sections" id="{{ __('commons.contact') }}" style="display: none;">
                <h3>{{ __('commons.contact') }}</h5>
            </div>
        </div>
    </div>
</div>
@endsection

@section("otherscripts")
<script>
    $(document).ready(function() {
        $(".ui.radio.checkbox").checkbox();
        var selected_section = "{{ __('commons.privacy') }}";
        $(".ui.vertical.fluid.menu .item").first().addClass("active");
        $("#"+selected_section).show();
        $(".ui.vertical.fluid.menu .item").click(function(){
            $(".item").removeClass("active");
            $(this).addClass("active");
            selected_section = $(this).text().trim();
            console.log("#"+selected_section);
            $(".resume_sections").hide();
            $("#"+selected_section).show();
        });
    });
</script>
@endsection

