@extends('layouts.default')
@section('content')
   <h1>Please Register</h1>

   {!! Form::open(['route' => 'reship', 'method' => 'post']) !!}
      {!! Form::submit('reship letter') !!}
   {!! Form::close() !!}

@stop