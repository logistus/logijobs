@extends('layouts.app')

@section("othercss")
@endsection

@section('content')
@include('search')
<div class="ui container segment grid">
    @include('settings_divided_list')
    <div class="row">
        <div class="column">
            <div class="ui blue big ribbon label">{{ __('commons.resumes') }}</div>
            <p style="text-align: right;"><a href="/create_resume" class="ui green button">{{ __('commons.create_resume') }}</a></p>
            <h4 class="ui horizontal divider header" style="padding-bottom: 20px;"> {{ __('commons.resumes') }} </h4>
            @if (count($user_resumes) > 0)
                <div class="ui three stackable cards">
                @foreach ($user_resumes as $user_resume)
                    <div class="card resume_{{ $user_resume->id }}" style="background-color: #fafafa;">
                        <div class="content">
                            <div class="ui active centered floated loader loader_{{ $user_resume->id }} hidden"></div>
                            <div class="header"><a href="/edit_resume/{{ $user_resume->id }}">{{ $user_resume->name }}</a></div>
                            <div class="meta">
                                <span class="right floated time">
                                    <a id="{{ $user_resume->id }}" class="update_resume_date" href="#">{{ __('commons.update_date') }}</a>
                                </span>
                                <span class="category">{{ $user_resume->language }}</span>
                            </div>
                        </div>
                        <div class="extra content">
                            <button class="ui tiny red button delete_resume" type="button" id="{{ $user_resume->id }}">{{ __('commons.delete') }}</button>
                            <div class="ui toggle checkbox">
                                <input type="checkbox" tabindex="0" class="hidden" id="{{ $user_resume->id }}" {{ $user_resume->status == 1 ? "checked=checked" : "" }}>
                                <label class="resume_status_text_{{ $user_resume->id }}">{{ $user_resume->status == 1 ? __('commons.active') : __('commons.passive') }}</label>
                            </div>
                            <div class="right floated"><strong>{{ __('commons.last_update') }}</strong><br>
                            <span class="resume_updated_at_text_{{ $user_resume->id }}">{{ Date::parse($user_resume->updated_at)->ago() }}</span></div>
                        </div>
                    </div>
                @endforeach
                </div>
            @else
                <div class="ui message">{{ __('commons.no_resume') }}</div>
            @endif
        </div>
    </div>
@endsection

@section("otherscripts")
<script>
    $(function() {
        $('.ui.toggle.checkbox').checkbox({
            onChange: function() {
                var id = $(this).attr("id");
                $(".loader_"+id).show();
                $.get("/change_resume_status/"+id, function(data){
                    if (data == 0) {
                        alert("{{ __('commons.no_access_to_resume') }}");
                    } else {
                        var resume = JSON.parse(data);
                        if(resume.status == 1)
                            $(".resume_status_text_"+id).html("{{ __('commons.active') }}");
                        else
                            $(".resume_status_text_"+id).html("{{ __('commons.passive') }}");
                        $(".resume_updated_at_text_"+id).text("{{ Date::now()->ago() }}");
                        $(".loader_"+id).hide();
                    }
                });
            }
        });
        $(".update_resume_date").click(function(e){
            e.preventDefault();
            var id = $(this).attr("id");
            $(".loader_"+id).show();
            $.get("/update_resume_date/"+id, function(data){
                if (data == 1) {
                    $(".resume_updated_at_text_"+id).text("{{ Date::now()->ago() }}");
                    $(".loader_"+id).remove();
                } else {
                    alert("{{ __('commons.no_access_to_resume') }}");
                }
            });
        });
        $(".delete_resume").click(function(e){
            var id = $(this).attr("id");
            var ask = confirm("{{ __('commons.are_you_sure') }}?");
            if (ask) {
                $.get("/delete_resume/"+id, function(data){
                    if (data > 0) {
                        $(".resume_"+id).hide();
                    } else if(data == 0) {
                        $(".resume_"+id).hide();
                        $(".cards").after("<div class='ui message'>{{ __('commons.no_resume') }}</div>");
                    } else {
                        alert("{{ __('commons.no_access_to_resume') }}");
                    }
                });
            }
        });
    });
</script>
@endsection