@extends('layouts.app')

@section('content')
<form action="{{ route('password.request') }}" method="POST" class="col-sm-6 py-3 my-3">
    <input type="hidden" name="token" value="{{ $token }}">
    {!! csrf_field() !!}
    <h1>Reset Password</h1>
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ $email or old('email') }}" required>
    </div>
    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" required>
    </div>
    <div class="form-group">
        <label for="password_confirmation">Confirm Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
    </div>
    <button type="submit" class="btn btn-primary">Reset Password</button>
</form>
@endsection
