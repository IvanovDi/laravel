@extends('layouts.default')
@section('content')
   <h1>To confirm registration go the link in your mail</h1>

   {!! Form::open(['route' => 'reship', 'method' => 'post']) !!}
      {!! Form::submit('reship letter') !!}
   {!! Form::close() !!}

@stop