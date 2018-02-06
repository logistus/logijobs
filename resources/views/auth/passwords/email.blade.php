@extends('layouts.app')

@section('content')
<form action="{{ route('password.email') }}" method="POST" class="col-sm-6 py-3 my-3">
    {!! csrf_field() !!}
    <h1>Reset Password</h1>
    @include("errors")
    <div class="form-group">
        <label for="email">Email address</label>
        <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required autofocus>
    </div>
    <button type="submit" class="btn btn-primary">Send Password Reset Link</button>
</form>
@endsection
