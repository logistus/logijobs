@extends('layouts.app')

@section("othercss")
@endsection

@section('content')
    @include('search')
    <div class="ui container segment grey stacked grid">
        <div class="row">
            <div class="four wide computer sixteen wide mobile column">
                @include('settings_divided_list')
            </div>
            <div class="twelve wide computer sixteen wide mobile column">
                <h3 class="ui top attached inverted header">{{ __('commons.account_settings') }}</h3>
                <form action="/account_settings" method="POST" class="ui attached segment" id="account_settings">
                    <div class="ui icon message">
                        <i class="info icon"></i>
                        <div class="content">
                            <p>{{ __('commons.shared_info_msg') }}</p>
                        </div>
                    </div>
                    @csrf
                    <div class="ui form" id="as_form">
                        <div class="required field">
                            <label for="first_name">{{ __('commons.first_name') }}</label>
                            <input type="text" id="first_name" name="first_name" value="{{ Auth::user()->first_name }}">
                        </div>
                        <div class="required field">
                            <label for="last_name">{{ __('commons.last_name') }}</label>
                            <input type="text" id="last_name" name="last_name" value="{{ Auth::user()->last_name }}">
                        </div>
                        <div class="required field">
                            <label for="email">{{ __('commons.email') }}</label>
                            <input type="email" id="email" name="email" value="{{ Auth::user()->email }}">
                        </div>
                        <button type="submit" class="fluid ui teal button">{{ __('commons.save') }}</button>
                    </div>
                </form>
                <h3 class="ui top attached inverted header">{{ __('commons.change_password') }}</h3>
                <form action="/change_password" method="POST" class="ui attached segment" id="change_password">
                    @csrf
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
        $(function () {
            $("#account_settings").submit(function () {
                $("#as_form").addClass("loading");
            });
            $("#change_password").submit(function () {
                $("#cp_form").addClass("loading");
            });
        });
    </script>
@endsection