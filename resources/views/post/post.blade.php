@extends('layouts.default')
@section('content')
    <div class="article">
        <h1>{{$post->title}}</h1>
        <p>{{$post->description}}</p>
        <p>{{" create - $post->created_at  update - $post->updated_at"}}</p>
        {!! Form::open(['route' => ['addComment', $post->id], 'method' => 'get']) !!}
            {!! Form::submit('Add Comment') !!}
        {!!Form::close()!!}
        <div class="form-group">
            <table>
                @foreach($post->comments as $item)
                    {{--<tr ><td style="display: inline-block; border: 2px solid #000; padding: 30px;">--}}
                            {{--{{$item->description}}--}}
                    {{--</td></tr>--}}
                    <div class="panel panel-default">
                        <div class="panel-heading" style="background: #fff9f2;">
                            <div class="row">
                                {{$item->description}}
                                {{--<p style="margin-left: 15px; color: #2e4bad;">Author: {!! \App\User::find($comment['user_id'])->name !!}</p>--}}
                                <div class="col-md-6" style="display: inline-block">
                                    <p>Created : {!! $item['created_at'] !!}</p>
                                </div>
                                <div class="col-md-6" style="display: inline-block; text-align: right;">
                                    <p>Updated : {!! $item['updated_at'] !!}</p>
                                </div>
                            </div>
                        </div>
                        <div class="panel-body">
                            <p>{!! $item['text'] !!}</p>
                            <div style="text-align: right">
                                <a href="{!! route('likeComment', $item['id']) !!}" class="btn">
                                    LIKE
                                    @if($item->likes()->find(\Auth::user()->id))
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
        </div>
    </div>
@stop