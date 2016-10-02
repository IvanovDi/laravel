@extends('layouts.default')
@section('content')
    <h1>You Comment</h1>
    <form action="{{route('saveComment', $id)}}" method="get">
        <textarea name="description" id="" cols="30" rows="10" class="form-control" resize="none"></textarea>
        <input type="submit" value="Save Comment" name="new_comment">
    </form>

    {{--{!! Form::open(['route' => ['saveComment', $id], 'method' => 'get']) !!}--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::label('Add Comment') !!}--}}
            {{--{!! Form::textarea(['name' => 'description']) !!}--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--{!! Form::submit('Save Comment') !!}--}}
        {{--</div>--}}
    {{--{!! Form::close()!!}--}}
@stop