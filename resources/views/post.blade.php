@extends('layouts.blog-home')

@section('content')


<div class="row">

    <div class="col-md-8">
    <!-- Blog Post -->

    <!-- Title -->
    <h1>{{$post->title}}</h1>

    <!-- Author -->
    <p class="lead">
        by {{$post->user->name}}
    </p>

    <hr>

    <!-- Date/Time -->
    <p><span class="glyphicon glyphicon-time"></span> Posted {{$post->created_at->diffForHumans()}}</p>

    <hr>

    <!-- Preview Image -->
    <img class="img-responsive" src="{{$post->photo->file ? $post->photo->file : $post->photoPlaceholder()}}" alt="">

    <hr>

    <!-- Post Content -->
    <p>{!!$post->body!!}</p>
    <hr>


    <!-- Blog Comments -->
@if(Auth::check())
    <!-- Comments Form -->
    <div class="well">
        <h4>Leave a Comment:</h4>


        {!! Form::open(['method'=>'POST', 'action'=> 'PostCommentsController@store']) !!}


        <input type="hidden" name="post_id" value="{{$post->id}}">


        <div class="form-group">
            {!! Form::label('body', 'Body:') !!}
            {!! Form::textarea('body', null, ['class'=>'form-control','rows'=>3])!!}
        </div>

        <div class="form-group">
            {!! Form::submit('Submit comment', ['class'=>'btn btn-primary']) !!}
        </div>
        {!! Form::close() !!}

    </div>
@endif
    <hr>

    <!-- Posted Comments -->

    @if(count($comments) > 0)

        @foreach($comments as $comment)

    <!-- Comment -->
    <div class="media">
        <a class="pull-left" href="#">
            <img height="64" class="media-object" src="{{$comment->photo}}" alt="">
            {{--<img height="64" class="media-object" src="{{Auth::user()->gravatar}}" alt="">--}}

        </a>
        <div class="media-body">
            <h4 class="media-heading">{{$comment->author}}
                <small>{{$comment->created_at->diffForHumans()}}</small>
            </h4>
            <p>{{$comment->body}}</p>


            <div class="comment-reply-container">

                <button class="toggle-reply btn btn-primary pull-right">Reply</button>

                <div class="comment-reply col-sm-6">

                    {!! Form::open(['method' => 'POST', 'action' => 'CommentRepliesController@createReply', 'files' => true]) !!}

                    <input type="hidden" name="comment_id" value="{{$comment->id}}">

                    <div class="form-group">
                        {!! Form::label('body', 'Body:') !!}
                        {!! Form::textarea('body', null, ['class' => 'form-control', 'rows' => 2]) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::submit('Reply', ['class' => 'btn btn-primary']) !!}
                    </div>
                    {!! Form::close() !!}

                </div>
            </div>

        @if(count($comment->replies) > 0)

            @foreach($comment->replies as $reply)

            @if($reply->is_active == 1)

            <!-- Nested Comment -->
            <div class="media" id="nested-comment">
                <a class="pull-left" href="#">
                    <img height="64" class="media-object" src="{{$reply->photo}}" alt="">
                </a>
                <div class="media-body">
                    <h4 class="media-heading">{{$reply->author}}
                        <small>{{$reply->created_at->diffForHumans()}}</small>
                    </h4>
                    {{$reply->body}}
                </div>

                </div>


                @endif
            @endforeach
@endif
        </div>
    </div>

        @endforeach

    @endif

    <!-- Comment -->

</div>

    @include('includes.front_sidebar')

    </div>

@stop

@section('scripts')
    <script
            src="https://code.jquery.com/jquery-3.3.1.min.js"
            integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
            crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

    <script>

        $(".comment-reply-container .toggle-reply").click(function(){

            $(this).next().slideToggle("slow");

        });

            </script>


    @stop