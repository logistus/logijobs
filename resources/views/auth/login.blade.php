@extends("layouts.app")

@section("content")
<div class="ui container segment grid">
    <div class="eight wide computer sixteen wide mobile column">
        <div class="ui blue big ribbon label">{{ __('commons.login') }}</div>
        <form action="/login" method="POST" style="margin-top: 20px;">
            {!! csrf_field() !!}
            <div class="ui form">
                <div class="field">
                    <label for="email">{{ __('commons.email') }}</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                </div>
                <div class="field">
                    <label for="password">{{ __('commons.password') }}</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="field">
                    <div class="ui grid">
                        <div class="eight wide left aligned column">
                            <div class="inline field">
                                <div class="ui checkbox">
                                    <input type="checkbox" tabindex="0" class="hidden" id="remember" name="remember">
                                    <label>{{ __('commons.remember_me') }}</label>
                                </div>
                            </div>
                        </div>
                        <div class="eight wide right aligned column">
                            <a href="/password/reset">{{ __('commons.forgot_password') }}</a>
                        </div>
                    </div>
                </div>
                <button type="submit" class="fluid ui teal button">{{ __('commons.login') }}</button>
            </div>
        </form>
    </div>
    <div class="eight wide computer sixteen wide mobile column"></div>
</div>
@endsection

@section("otherscripts")
<script>
    $(function() {
        $('.ui.checkbox').checkbox();
        $("form").submit(function() {
            $(".form").addClass("loading");
        });
    });
</script>
@endsection
