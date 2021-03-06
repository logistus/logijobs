<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Logi Jobs') }}</title>
    <link rel="stylesheet" href="{{ asset('css/semantic.css') }}"/>
    <style>
        @media screen and (max-width: 485px) {
            #register_btn { margin-top: 10px; }
        }
    </style>
    @yield("othercss")
</head>
<body>
<div class="ui grid container" style="margin-top: 0; margin-bottom: 0;">
    <div class="eight wide left aligned computer only tablet only column">
        <a href="/"><img src="{{ asset('img/logijobs.png') }}" alt="Logi Jobs"></a>
    </div>
    <div class="eight wide left aligned mobile only column">
        <a href="/"><img src="{{ asset('img/logijobs_mobile.png') }}" alt="Logi Jobs"></a>
    </div>
    <div class="eight wide right aligned column" style="margin-top: 10px">
        @if(Auth::check())
            <div class="ui text menu" style="margin: 0;">
                <div class="ui right dropdown item" id="user_menu">
                    {{ Auth::user()->first_name }} {{ Auth::user()->last_name }}
                    <i class="dropdown icon"></i>
                    <div class="menu">
                        <a href="/settings" class="item">{{ __('commons.settings') }}</a>
                        <a href="/infos" class="item">{{ __('commons.personal_info') }}</a>
                        <a href="/resume" class="item">{{ __('commons.resumes') }}</a>
                        <a href="#" class="item">{{ __('commons.applied_jobs') }}</a>
                        <a href="#" class="item">{{ __('commons.saved_searches') }}</a>
                        <a href="#" class="item">{{ __('commons.messages') }}</a>
                        <a href="#" class="item">{{ __('commons.favorites') }}</a>
                        <a href="/logout" class="item"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('commons.logout') }}</a>
                        <form id="logout-form" action="/logout" method="POST"
                              style="display: none;">@csrf</form>
                    </div>
                </div>
            </div>
        @else
            <a href="/login" id="login_btn" class="ui basic blue button">{{ __('commons.login') }}</a>
            <a href="/register" id="register_btn" class="ui blue button">{{ __('commons.register') }}</a>
        @endif
    </div>
</div>
<div class="ui borderless grey inverted menu" style="margin: 0;">
    <div class="ui container computer only tablet only grid" style="margin: 0;">
        <a {!! Request::is('/') ? 'class="active item"' : 'class="item"' !!} href="/">{{ __('commons.homepage') }}</a>
        <a {!! Request::is('/detailed_search') ? 'class="active item"' : 'class="item"' !!} href="/detailed_search">{{ __('commons.detailed_search') }}</a>
    </div>
    <div class="ui container mobile only grid" style="margin: 0;">
        <a class="ui icon item"><i class="align justify icon"></i>&nbsp;&nbsp;Menu</a>
    </div>
</div>
@yield('content')
<script src="http://code.jquery.com/jquery-3.3.1.min.js"></script>
<script src="{{ asset('js/semantic.js') }}"></script>
<script src="{{ asset('js/jquery.inputmask.bundle.min.js') }}"></script>
@yield("otherscripts")
<script>
    $(function () {
        $('#user_menu').dropdown({
            on: 'hover',
        });
        $('#search_city').dropdown({
            useLabels: false,
        });
        $('.ui.radio.checkbox').checkbox();
        $(document).on('click', '.message .close', function () {
            $(this)
                .closest('.message')
                .transition('fade')
            ;
        });
    });
</script>
</body>
</html>
