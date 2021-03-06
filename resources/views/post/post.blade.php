@extends('layouts.default')
@section('content')
    <div class="article">
        <h1>{{$post->title}}</h1>
        <img src="{!! '../images/' . $post->image !!}" alt="picture">
        <p>{{$post->description}}</p>
        <p>{{" create - $post->created_at  update - $post->updated_at"}}</p>
        <div style="border: solid 1px black; text-align: center;">
            <h3>Notification</h3>
                @foreach ($post->user->unreadNotifications as $notification)
                @if(Auth::user()->name === $notification->data['user'])
                {{$notification->data['user']}}
                    {{$notification->created_at}} <br>
                    @if(Auth::user()->email === $post->user->email)
                        {{$notification->markAsRead()}}
                    @endif
                @endif
            @endforeach
        </div>
        <div class="form-group">
            <div class="panel-heading" >
                {!! Form::open(['route' => ['comment.save', $post->id], 'method' => 'get']) !!}
                <textarea name="description" rows="2" class="form-control"></textarea>
                {!! Form::submit('Add Comment') !!}
                {!!Form::close()!!}
                <p style="color: red">{!! $errors->first('description') !!}</p>
            </div>
            <table>
                @foreach($comments as $item)
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background: #fff9f2;">
                            <div class="row">
                                {{$item->description}}
                                <div class="col-md-6" style="display: inline-block">
                                    <p>Created : {!! $item['created_at'] !!}</p>
                                </div>
                                <div class="col-md-6" style="display: inline-block; text-align: right;">
                                    <p>Updated : {!! $item['updated_at'] !!}</p>
                                </div>
                                <div class="col-md-6" style="display: inline-block; ">
                                    @if(\Carbon\Carbon::now() < Carbon\Carbon::parse($item->created_at)->addMinutes(10))
                                    {!! Form::open(['route' => ['comment.edit', $item->id], 'method' => 'get']) !!}
                                        <textarea name="description" rows="2" class="form-control">{!! $item->description !!}</textarea>
                                        {!! Form::submit('Edit') !!}
                                    {!! Form::close() !!}
                                    @endif
                                    @if($item->edit === 1)
                                        COMMENT EDITED!!!
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <p>{!! $item['text'] !!}</p>
                            <div style="text-align: right">
                                {{$like->get('comment_' . $item->id)}}
                                <a href="{!! route('comment.like', $item['id']) !!}" class="btn">
                                    LIKE
                                    @if($item->likes->first())
                                        good
                                    @else
                                        bad
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </table>
            {!!$comments->render()!!}
        </div>
    </div>
@stop