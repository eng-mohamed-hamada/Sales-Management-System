@extends('layouts.guest')

@section('content')
@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

<form class="form-horizontal" method="POST" action="{{ route('password.email') }}">
    {{ csrf_field() }}

    <div class=" form-group{{ $errors->has('email') ? ' has-error' : '' }}">
        <label for="email" class="col-xs-12 text-center">الايميل</label>

        <div class="col-xs-12">
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

            @if ($errors->has('email'))
                <span class="help-block">
                    <strong>{{ $errors->first('email') }}</strong>
                </span>
            @endif
        </div>
    </div>

    <div class="form-group col-xs-12 text-center">
        <button type="submit" class="btn btn-success col-xs-12">ارسال رابط تعيين الرقم السرى</button>
        <a class="btn btn-link col-xs-12" href="{{ url("/login") }}">
            تسجيل دخول 
        </a>    
    </div>
</form>
@endsection
