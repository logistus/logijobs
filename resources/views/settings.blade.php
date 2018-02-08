@extends('layouts.app')

@section("othercss")
@endsection

@section('content')
@include('search')
<div class="ui container segment grid">
    @include('settings_divided_list')
    <div class="row">
        <div class="twelve wide computer sixteen wide mobile column">
            <div class="ui blue big ribbon label">{{ __('commons.account_settings') }}</div>
            <form action="/account_settings" method="POST" id="account_settings" style="margin-top: 20px;">
                {!! csrf_field() !!}
                <div class="ui form" id="as_form">
                    <div class="required field">
                        <label for="name">{{ __('commons.full_name') }}</label>
                        <input type="text" id="name" name="name" value="{{ Auth::user()->name }}">
                    </div>
                    <div class="required field">
                        <label for="email">{{ __('commons.email') }}</label>
                        <input type="email" id="email" name="email" value="{{ Auth::user()->email }}">
                    </div>
                    <button type="submit" class="fluid ui teal button">{{ __('commons.save') }}</button>
                </div>
            </form>
            <div class="ui blue big ribbon label" style="margin-top: 50px;">{{ __('commons.change_password') }}</div>
            <form action="/change_password" method="POST" id="change_password" style="margin-top: 20px;">
                {!! csrf_field() !!}
                <div class="ui form" id="cp_form">
                    <div class="required field">
                        <label for="current_password">{{ __('commons.current_password') }}</label>
                        <input type="password" id="current_password" name="current_password">
                    </div>
                    <div class="required field">
                        <label for="new_password">{{ __('commons.new_password') }}</label>
                        <input type="password" id="new_password" name="new_password">
                    </div>
                    <div class="required field">
                        <label for="new_password_confirmation">{{ __('commons.new_password_confirmation') }}</label>
                        <input type="password" id="new_password_confirmation" name="new_password_confirmation">
                    </div>
                    <button type="submit" class="fluid ui teal button">{{ __('commons.save') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@section("otherscripts")
<script>
    $(function() {
        $("#account_settings").submit(function() {
            $("#as_form").addClass("loading");
        });
        $("#change_password").submit(function() {
            $("#cp_form").addClass("loading");
        });
    });
</script>
@endsection