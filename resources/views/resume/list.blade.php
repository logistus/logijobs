@extends('layouts.app')

@section("othercss")
@endsection

@section('content')
    @include('search')
    <div class="ui container segment grey grid">
        <div class="row">
            @include('settings_divided_list')
            <div class="twelve wide computer sixteen wide mobile column">
                <div class="ui grid">
                    <div class="row">
                        <div class="column">
                            <button type="button" class="ui right floated green button"
                                    id="btn-create-resume">{{ __('commons.create_resume') }}</button>
                        </div>
                    </div>
                    <div class="row">
                        <div class="column" id="column_resumes">
                            @if (count($user_resumes) > 0)
                                @foreach ($user_resumes as $user_resume)
                                    <div class="ui fluid card resume_{{ $user_resume->id }}"
                                         style="background-color: #fafafa;">
                                        <div class="content">
                                            <div class="ui active centered floated loader loader_{{ $user_resume->id }} hidden"></div>
                                            <div class="header"><a
                                                        href="/resume/{{ $user_resume->id }}">{{ $user_resume->name }}</a>
                                            </div>
                                            <div class="meta">
                                <span class="right floated time">
                                    <a id="{{ $user_resume->id }}" class="update_resume_date"
                                       href="#">{{ __('commons.update_date') }}</a>
                                </span>
                                                <span class="category">{{ $user_resume->language }}</span>
                                            </div>
                                        </div>
                                        <div class="extra content">
                                            <button class="ui tiny red button delete-resume" type="button"
                                                    id="{{ $user_resume->id }}">{{ __('commons.delete') }}</button>
                                            <div class="ui toggle checkbox">
                                                <input type="checkbox" tabindex="0" class="hidden"
                                                       id="{{ $user_resume->id }}"
                                                        {{ $user_resume->status == 1 ? "checked=checked" : "" }}>
                                                <label class="resume_status_text_{{ $user_resume->id }}">
                                                    {{ $user_resume->status == 1 ? __('commons.active') : __('commons.passive') }}
                                                </label>
                                            </div>
                                            <div class="right floated">
                                                <strong>{{ __('commons.last_update') }}</strong><br>
                                                <span class="resume_updated_at_text_{{ $user_resume->id }}">{{ Date::parse($user_resume->updated_at)->ago() }}</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="ui message">{{ __('commons.no_resume') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="ui mini modal create-resume">
            <div class="header">{{ __('commons.create_resume') }}</div>
            <div class="description">
                <div class="ui fluid form" style="padding: 10px 10px 0 10px;">
                    <div class="sixteen wide field">
                        <label for="name">{{ __('commons.resume_name') }}</label>
                        <input type="text" name="name" id="name"
                               placeholder="{{ __('commons.resume_name_placeholder') }}">
                    </div>
                    <div class="inline fields">
                        <label for="language">{{ __('commons.resume_language') }}</label>
                        <div class="field">
                            <div class="ui radio checkbox">
                                <input type="radio" name="language" tabindex="0" value="{{ __('commons.turkish') }}"
                                       class="hidden">
                                <label>{{ __('commons.turkish') }}</label>
                            </div>
                        </div>
                        <div class="field">
                            <div class="ui radio checkbox">
                                <input type="radio" name="language" tabindex="0" value="{{ __('commons.english') }}"
                                       class="hidden">
                                <label>{{ __('commons.english') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="actions">
                <div href="#" class="ui negative button">{{ __('commons.cancel') }}</div>
                <div href="#" class="ui positive button" id="create_resume">{{ __('commons.create') }}</div>
            </div>
        </div>
        <div class="ui mini modal confirm-delete-resume">
            <div class="header">{{ __('commons.resume') }} {{ __('commons.delete') }}</div>
            <div class="content">
                <p>{{ __('commons.are_you_sure') }}?</p>
            </div>
            <div class="actions">
                <div href="#" class="ui negative button">{{ __('commons.no') }}</div>
                <div href="#" class="ui positive button btn-delete-resume">{{ __('commons.yes') }}</div>
            </div>
        </div>
        @endsection

        @section("otherscripts")
            <script>
                $(function () {
                    $('.ui.radio.checkbox').checkbox();
                    $("#create_resume").click(function () {
                        var name = $("#name").val();
                        var language = $('[name="language"]:checked').val();
                        if (name == "" || language == undefined) {
                            alert("{{ __('commons.name_and_language_required') }}");
                            return false;
                        } else {
                            $.post("/resume", {
                                name: name,
                                language: language,
                                _token: '{{csrf_token()}}'
                            }, function (data) {
                                if (data) {
                                    $("#column_resumes").html("").addClass("ui").addClass("loader");
                                    location.href = "/resume/" + data;
                                }
                            });
                        }
                    });
                    $("#btn-create-resume").click(function () {
                        $(".create-resume").modal('show');
                    });

                    $('.ui.toggle.checkbox').checkbox({
                        onChange: function () {
                            let id = $(this).attr("id");
                            $(".loader_" + id).show();
                            $.ajax({
                                url: "/resume/" + id + "/update/status",
                                type: "patch",
                                data: {_token: '{{csrf_token()}}'},
                                success: function (data) {
                                    if (data == 0) {
                                        alert("{{ __('commons.no_access_to_resume') }}");
                                    } else {
                                        if (data === true)
                                            $(".resume_status_text_" + id).html("{{ __('commons.active') }}");
                                        else
                                            $(".resume_status_text_" + id).html("{{ __('commons.passive') }}");
                                        $(".resume_updated_at_text_" + id).text("{{ Date::now()->ago() }}");
                                        $(".loader_" + id).hide();
                                    }
                                }
                            });
                        }
                    });

                    $(".update_resume_date").click(function (e) {
                        e.preventDefault();
                        let id = $(this).attr("id");
                        $(".loader_" + id).show();
                        $.ajax({
                            url: "/resume/" + id + "/update/date",
                            type: "patch",
                            data: {_token: '{{csrf_token()}}'},
                            success: function (data) {
                                if (data == 1) {
                                    $(".resume_updated_at_text_" + id).text("{{ Date::now()->ago() }}");
                                    $(".loader_" + id).remove();
                                } else {
                                    alert("{{ __('commons.no_access_to_resume') }}");
                                }
                            }
                        });
                    });

                    $(".delete-resume").click(function () {
                        $(".confirm-delete-resume").modal("show");
                        $(".btn-delete-resume").attr("id", $(this).attr("id"));
                    });

                    $(".btn-delete-resume").click(function () {
                        let id = $(this).attr("id");
                        $.ajax({
                            url: "/resume/" + id,
                            type: "delete",
                            data: {_token: '{{csrf_token()}}'},
                            success: function (data) {
                                if (data > 0) {
                                    $(".resume_" + id).hide();
                                } else if (data == 0) {
                                    $(".resume_" + id).hide();
                                    $("#column_resumes").append("<div class='ui message'>{{ __('commons.no_resume') }}</div>");
                                } else {
                                   $("#column_resumes").append("<div class='ui error message'>" +
                                       "<i class='close icon'></i>{{ __('commons.no_access_to_resume') }}</div>");
                                }
                            }
                        });
                    });
                });
            </script>
@endsection