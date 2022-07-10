@extends('layouts.guest')
@section('content')
<form class="form-horizontal" method="POST" action="{{ route('login') }}">
    {{ csrf_field() }}

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-md-12">الايميل</label>

        <div class="col-md-12">
            <input id="email" type="email" class="text-center form-control" name="email" value="{{ old('email') }}" required autofocus>

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
        <label for="password" class="col-md-12">كلمة المرورو</label>

        <div class="col-md-12">
            <input id="password" type="password" class="text-center form-control" name="password" required>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-12 text-left">
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> تذكرنى
                </label>
            </div>
        </div>
    </div>

    <div class="form-group">
        <div class="col-md-12 text-center">
            <button type="submit" class="btn btn-success col-xs-12">
                تسجيل دخول
            </button>
            <br>
            <a class="btn btn-link" href="{{ route('password.request') }}">
                نسيت كلمة السر?
            </a>
            <a class="btn btn-success col-xs-12" href="{{ url("/register") }}">
                انشاء حساب جديد
            </a>
        </div>
    </div>
</form>
@endsection
