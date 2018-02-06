<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Logi Jobs') }}</title>
    <link rel="stylesheet" href="{{ asset('css/semantic.css') }}" />
    @yield("othercss")
</head>
<body>
    <div class="ui grid container" style="margin-top: 0; margin-bottom: 0;">
      <div class="eight wide left aligned column"><a href="/"><img src="{{ asset('img/logo.png') }}" alt="Logi Jobs"></a></div>
      <div class="eight wide right aligned column" style="margin-top: 10px">
        @if(Auth::check())
        <div class="ui text menu" style="margin: 0;">
          <div class="ui right dropdown item">
            {{ Auth::user()->name }}
            <i class="dropdown icon"></i>
            <div class="menu">
              <a href="/settings" class="item">{{ __('commons.settings') }}</a>
              <a href="#" class="item">{{ __('commons.resumes') }}</a>
              <a href="#" class="item">{{ __('commons.applied_jobs') }}</a>
              <a href="#" class="item">{{ __('commons.saved_searches') }}</a>
              <a href="#" class="item">{{ __('commons.messages') }}</a>
              <a href="#" class="item">{{ __('commons.favorites') }}</a>
              <a href="/logout" class="item" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('commons.logout') }}</a>
              <form id="logout-form" action="/logout" method="POST" style="display: none;">{{ csrf_field() }}</form>
            </div>
          </div>
        </div>
        @else
        <a href="/login" class="ui basic blue button">{{ __('commons.login') }}</a>
        <a href="/register" class="ui blue button">{{ __('commons.register') }}</a>
        @endif
      </div>
    </div>
    <div class="ui borderless grey inverted menu" style="margin: 0;">
      <div class="ui container computer only tablet only grid" style="margin: 0;">
          <a {!! Request::is('/') ? 'class="active item"' : 'class="item"' !!} href="/">{{ __('commons.home') }}</a>
          <a {!! Request::is('/detailed_search') ? 'class="active item"' : 'class="item"' !!} href="/detailed_search">{{ __('commons.detailed_search') }}</a>
      </div>
      <div class="ui container mobile only grid" style="margin: 0;">
        <a class="ui icon item"><i class="align justify icon"></i>&nbsp;&nbsp;Menu</a>
      </div>
    </div>
  @include("flash")
  @include("errors")
  @yield('content')
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="{{ asset('js/semantic.js') }}"></script>
  <script>
    $(function(){
      $('.ui.dropdown').dropdown({
        on: 'hover',
      });
      $('.message .close').on('click', function() {
          $(this)
          .closest('.message')
          .transition('fade')
          ;
      });
    });
  </script>
  @yield("otherscripts")
</body>
</html>
