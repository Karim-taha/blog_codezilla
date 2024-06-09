@extends('layouts.app')
@section('title')
    All Posts
@endsection
@section('content')
    <div class="text-center mb-4">
        <a href="{{ route('post.create') }}" class="btn btn-success">Add Post</a>
    </div>
    <table class="table table-striped text-center">
  <thead>
    <tr>
      <th scope="col">#</th>
      <th scope="col">Title</th>
      <th scope="col">Author</th>
      <th scope="col">Created at</th>
      <th scope="col">Actions</th>
    </tr>
  </thead>
  <tbody>
    @php
        $counter = 1;
    @endphp
    @foreach($posts as $post)
        <tr>
        <th scope="row">{{ $counter }}</th>
        <td>{{$post->title}}</td>
        <td>{{$post->user_id == null ? '-' : $post->user->name}}</td>
        <td>{{$post->created_at->format('Y-m-d h:i:s A')}}</td>
        <td>
            <a href="{{ route('posts.show', $post->slug) }}" class="btn btn-info">View</a>
            <a href="{{ route('posts.edit', $post->slug) }}" class="btn btn-warning">Edit</a>
            <form style="display: inline" action="{{ route('posts.destroy', $post->id) }}" method="POST">
                @csrf
                @method('Delete')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </td>
        </tr>
        @php
        $counter++;
    @endphp
    @endforeach

  </tbody>
</table>
@endsection
