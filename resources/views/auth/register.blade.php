@extends("layouts.app")

@section("content")
@if(!session()->has('message'))
<div class="ui container segment grid">
    <div class="eight wide computer sixteen wide mobile column">
        <div class="ui blue big ribbon label">{{ __('commons.register') }}</div>
        <form action="/register" method="POST" style="margin-top: 20px;">
            {!! csrf_field() !!}
            <div class="ui form">
                <div class="field">
                    <label for="name">{{ __('commons.full_name') }}</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required>
                </div>
                <div class="field">
                    <label for="email">{{ __('commons.email') }}</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="field">
                    <label for="password">{{ __('commons.password') }}</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="field">
                    <label for="password_confirmation">{{ __('commons.password_confirmation') }}</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" required>
                </div>
                <p><a href="#">{{ __('commons.terms_of_service') }}</a>nı {{ __('commons.i_accept') }}</p>
                <button type="submit" class="fluid ui teal button">{{ __('commons.register') }}</button>
            </div>
        </form>
    </div>
    <div class="eight wide computer sixteen wide mobile column"></div>
</div>
@endif
@endsection

@section("otherscripts")
<script>
    $(function() {
        $("form").submit(function() {
            $(".form").addClass("loading");
        });
    });
</script>
@endsection
