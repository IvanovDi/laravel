@extends('layouts.default')
@section('content')
    <h1>Создание Поста</h1>
    {!! Form::open(['route' => 'post.store', 'method' => 'post', 'files' => true]) !!}
    <div class="form-group">
        {!! Form::label('title') !!}
        {!! Form::text('title', null,
            ['required',
                  'class'=>'form-control',
                  'placeholder'=>'Title']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('text', 'Description') !!}
        {!! Form::textarea('text', null, [
            'required',
            'name' => 'description',
            'class' => 'form-control',
            'placeholder' => 'Article text'
        ]) !!}
    </div>

    <div class="form-group">
        {!! Form::label('image', 'Image') !!}
        {!! Form::file('image', null)!!}
    </div>

    <div class="form-group" style="display: inline-block;margin-left: 10px;">
        {!! Form::submit('Save', [
            'class' => 'btn btn-primary'
        ]) !!}
    </div>
    {!! form::close() !!}

@stop