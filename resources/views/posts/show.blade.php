@extends('layouts.app')

@section('title')
    Show Post
@endsection

@section('content')
    <div class="card">
    <div class="card-header bg-dark text-white">
        Post Info
    </div>
    <div class="card-body">
        <h5 class="card-title">Title: {{$post->title}}</h5>
        <p class="card-text">Description: {{$post->description}}</p>
    </div>
    </div>
    <div class="card mt-3">
    <div class="card-header bg-dark text-white">
        Post Creator Info
    </div>
    <div class="card-body">
        <h5 class="card-title">Name: {{ $post->user_id == null ? 'No Author' : $post->user->name }}</h5>
        <p class="card-text">Email: {{ $post->user_id == null ? 'No Email' : $post->user->email }}</p>
        <p class="card-text">Created at: {{$post->user_id == null ? 'No Time' : $post->created_at->format('Y-m-d h:i:s A')}}</p>
    </div>
    </div>
    <div class="text-center mt-3">
        <a href="{{ route('posts.edit', $post->slug) }}" class="btn btn-warning">Edit</a>
            <form style="display: inline" action="{{ route('posts.destroy', $post->id) }}" method="POST">
                @csrf
                @method('Delete')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
    </div>

@endsection
