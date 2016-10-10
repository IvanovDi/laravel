@extends('layouts.default')
@section('content')
    <h1>Profile</h1>
    <div class="form-group">
        {!! Form::open(['route' => ['profile.editName', \Auth::user()->id], 'method' => 'post', 'class' => 'form']) !!}
            {!! Form::label('New Name') !!}<br> {{--todo название лейбла должно соответствовать названию поля. Если хочешь его изменить, напиши через запятую то, что должно выводиться --}}
            {!! Form::text('name', \Auth::user()->name) !!}<br>
            {!! Form::submit('Edit Name') !!}
        {!! Form::close() !!}
        <p style="color: red">{{$errors->first('name')}}</p>
    </div>
    <div class="form-group">
        {!! Form::open(['route' => ['profile.editEmail', \Auth::user()->id], 'method' => 'post', 'class' => 'form']) !!}
        {!! Form::label('New Email') !!}<br>    {{--todo label--}}
        {!! Form::text('email', \Auth::user()->email) !!}<br>
        {!! Form::submit('Edit Email') !!}
        {!! Form::close() !!}
        <p style="color: red">{{$errors->first('email')}}</p>
    </div>
    <div class="form-group">
        {!! Form::open(['route' => ['profile.editPassword', \Auth::user()->id], 'method' => 'post', 'class' => 'form']) !!}
        {!! Form::label('New Password') !!}<br> {{--todo label--}}
        {!! Form::password('newPassword') !!}<br>
        <p style="color: red">{{$errors->first('newPassword')}}</p>
        {!! Form::label('Old Password') !!}<br>
        {!! Form::password('confirmPassword') !!}<br>
        <p style="color: red">{{$errors->first('confirmPassword')}}</p>
        {!! Form::submit('Edit Password') !!}
        {!! Form::close() !!}
    </div>
@stop