@extends('layouts.guest')
@section('content')
<form class="form-horizontal" method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
    {{ csrf_field() }}


        <div class="col-xs-12">
            <label for="email" class="control-label">الايميل</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>

        <div class="col-xs-12">
            <label for="photo" class="control-label">الصوره</label>
            <input id="photo" type="file" class="form-control" name="photo" value="{{ old('photo') }}" required>

            @if ($errors->has('photo'))
                <span class="help-block">
                    <strong>{{ $errors->first('photo') }}</strong>
                </span>
            @endif
        </div>

        <div class="col-xs-12">
            <label for="national_number" class="control-label">الرقم القومى</label>
            <input id="national_number" type="text" class="form-control" name="national_number" value="{{ old('national_number') }}" required>
            
            @if ($errors->has('national_number'))
                <span class="help-block">
                    <strong>{{ $errors->first('national_number') }}</strong>
                </span>
            @endif
        </div>

        <div class="col-xs-12">
            <label for="password" class="control-label">الرقم السرى</label>
            <input id="password" type="password" class="form-control" name="password" required>

            @if ($errors->has('password'))
                <span class="help-block">
                    <strong>{{ $errors->first('password') }}</strong>
                </span>
            @endif
        </div>


        <div class="col-xs-12">
            <label for="password-confirm" class="control-label">تاكيد الرقم السرى</label>
            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
        </div>

        <div class="col-xs-12">
            <br>
            <button type="submit" class="btn btn-success col-xs-12">
                إنشاء حساب
            </button>
            <a class="btn btn-link col-xs-12" href="{{ url("/login") }}">
                تسجيل دخول 
            </a>
            
            
        </div>
</form>
@endsection
