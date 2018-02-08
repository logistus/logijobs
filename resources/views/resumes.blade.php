@extends('layouts.app')

@section("othercss")
@endsection

@section('content')
@include('search')
<div class="ui container segment grid">
    <div class="four wide computer sixteen wide mobile column">
        @include('settings_divided_list')
    </div>
    <div class="twelve wide computer sixteen wide mobile column">
        <div class="ui blue big right ribbon label">{{ __('commons.resumes') }}</div>
        <p style="text-align: center;"><a href="/create_resume" class="ui green button">{{ __('commons.create_resume') }}</a></p>
        <h4 class="ui horizontal divider header"> {{ __('commons.resumes') }} </h4>
        @if (count($user_resumes) > 0)

        @else
            <div class="ui message">{{ __('commons.no_resume') }}</div>
        @endif
    </div>
@endsection