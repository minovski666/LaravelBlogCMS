@extends('layouts.admin')



@section('content')


    <h1>Posts</h1>


      <table class="table">
          <thead>
            <tr>
                <th>Id</th>
                <th>Photo</th>
                <th>User</th>
                <th>Category</th>
                <th>Title</th>
                <th>Body</th>
                <th>Posts</th>
                <th>Comments</th>
                <th>Created</th>
                <th>Updated</th>
            </tr>
          </thead>
          <tbody>

          @if($posts)

              @foreach($posts as $post)

            <tr>
                <td>{{$post->id}}</td>
                <td><img height="50" src="{{$post->photo ? $post->photo->file : 'http://placeholder.it/400x400'}}" alt=""></td>
                <td>{{$post->user->name}}</td>
                <td>{{$post->category ? $post->category->name : "Uncategoriezed"}}</td>
                <td><a href="{{route('admin.posts.edit', $post->id)}}">{{$post->title}}</a></td>
                <td>{{$post->body, 30}}</td>
                <td><a href="{{route('home.post', $post->id)}}">View Post</a></td>
                <td><a href="{{route('admin.comments.show', $post->id)}}">View Comments</a></td>
                <td>{{$post->created_at->diffForhumans()}}</td>
                <td>{{$post->updated_at->diffForhumans()}}</td>
            </tr>

              @endforeach

              @endif

          </tbody>
        </table>

    @stop