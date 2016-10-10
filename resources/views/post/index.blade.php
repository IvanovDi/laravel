@extends('layouts.default')
@section('content')
    <form action="{{route('post.create')}}" method="get">
        <input type="submit" value="add_Post" name="new_post">
    </form>
    <div class="article">
        @foreach($post as $item)
            <h2><a href="{{route('post.show', $item->id)}}">{{$item ->title}}</a> </h2> {{"created - $item->created_at , updated -  $item->updated_at"}}
            @if (\Auth::user()->id === $item['user_id'])
                {!! Form::open(['route' => ['post.delete', $item->id], 'class' => 'form', 'method' => 'get']) !!}
                {!! Form::submit('Delete Post',
                  ['class'=>'btn btn-danger']) !!}
                {!! Form::close() !!}
                amount comment -  {!! $item->comments_count !!}
            @endif
        @endforeach
    </div>
    {!! $post->render() !!}
@stop