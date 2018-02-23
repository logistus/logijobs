@extends('layouts.app')

@section("othercss")
@endsection

@section('content')
    @include('search')
    <div class="ui container segment grey stacked grid">
        <div class="row">
            @include('settings_divided_list')
            <div class="twelve wide computer sixteen wide mobile column">
                <h3 class="ui top attached inverted header" id="account_section">{{ __('commons.change_email') }}</h3>
                <form class="ui attached segment" id="change_email">
                    @csrf
                    <div class="ui form" id="as_form">
                        <div class="required field">
                            <label for="email">{{ __('commons.email') }}</label>
                            <input type="email" id="email" name="email" value="{{ Auth::user()->email }}">
                        </div>
                        <button id="save_email" class="fluid ui teal button">{{ __('commons.save') }}</button>
                    </div>
                </form>
                <h3 class="ui top attached inverted header">{{ __('commons.change_password') }}</h3>
                <form class="ui attached segment" id="change_password">
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
                        <button class="fluid ui teal button" type="button" id="save_password">{{ __('commons.save') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section("otherscripts")
    <script>
        $(function() {
            $("#change_email").form({
                fields: {
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
            $("#change_email").submit(function(e) {
                e.preventDefault();
                let email = $("#email").val();
                if ($('#change_email').form('is valid')) {
                    $("#save_email").addClass("loading");
                    $.post("/change_email", {email: email, _token: '{{csrf_token()}}'}, function (data) {
                        $("#save_email").removeClass("loading");
                        console.log(data);
                        if (data == 1) {
                            $("#account_section").before("<div class='ui success message'>" +
                                "<i class='close icon'></i>{{ __('commons.email_changed') }}");
                        } else if (data == 0) {
                            $("#account_section").before("<div class='ui error message'>" +
                                "<i class='close icon'></i>{{ __('commons.email_in_use') }}");
                        } else {
                            return true;
                        }
                    });
                }
            });
            $("#change_password").form({
                fields: {
                    current_password: {
                        rules: [
                            {
                                type: 'empty',
                                prompt: '{{ __("commons.current_password_required") }}'
                            }
                        ]
                    },
                    new_password: {
                        rules: [
                            {
                                type: 'empty',
                                prompt: '{{ __("commons.new_password_required") }}'
                            },
                            {
                                type: 'minLength[6]',
                                prompt: '{{ __("commons.your_password_at_least") }} {ruleValue} {{ __("commons.characters_long") }}'
                            }
                        ]
                    },
                    new_password_confirmation: {
                        rules: [
                            {
                                type: 'match[new_password]',
                                prompt: '{{ __("commons.passwords_do_not_match") }}'
                            }
                        ]
                    }
                },
                inline: true
            });
            $("#save_password").click(function(){
                $("#change_password").submit();
            });
            $("#change_password").submit(function(e) {
                e.preventDefault();
                e.stopImmediatePropagation();
                let current_password = $("#current_password").val();
                let new_password = $("#new_password_confirmation").val();
                if ($('#change_password').form('is valid')) {
                    $("#save_password").addClass("loading");
                    $.post("/change_password", {
                        current_password: current_password,
                        new_password: new_password,
                        _token: '{{csrf_token()}}'
                    }, function(data) {
                        $("#save_password").removeClass("loading");
                        if (data == 0) {
                            $("#account_section").before("<div class='ui error message'>" +
                                "<i class='close icon'></i>{{ __('commons.invalid_current_password') }}");
                        } else if (data == 1) {
                            $("#account_section").before("<div class='ui success message'>" +
                                "<i class='close icon'></i>{{ __('commons.password_changed') }}");
                            $("#current_password").val("");
                            $("#new_password").val("");
                            $("#new_password_confirmation").val("");
                        }
                    });
                }
            });
        });
    </script>
@endsection