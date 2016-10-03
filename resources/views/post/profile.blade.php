@extends('layouts.default')
@section('content')
    <h1>Profile</h1>
    <div class="form-group">
        {!! Form::open(['route' => ['editName', \Auth::user()->id], 'method' => 'get', 'class' => 'form']) !!}
            {!! Form::label('New Name') !!}<br>
            {!! Form::text('name') !!}<br>
            {!! Form::submit('Edit Name') !!}
        {!! Form::close() !!}
    </div>
    <div class="form-group">
        {!! Form::open(['route' => ['editEmail', \Auth::user()->id], 'method' => 'get', 'class' => 'form']) !!}
        {!! Form::label('New Email') !!}<br>
        {!! Form::text('email') !!}<br>
        {!! Form::label('Old Email') !!}<br>
        {!! Form::text('confirmEmail') !!}<br>
        {!! Form::submit('Edit Email') !!}
        {!! Form::close() !!}
    </div>
    <div class="form-group">
        {!! Form::open(['route' => ['editPassword', \Auth::user()->id], 'method' => 'get', 'class' => 'form']) !!}
        {!! Form::label('New Password') !!}<br>
        {!! Form::password('newPassword') !!}<br>
        {!! Form::label('Old Password') !!}<br>
        {!! Form::password('confirmPassword') !!}<br>
        {!! Form::submit('Edit Password') !!}
        {!! Form::close() !!}
    </div>
@stop