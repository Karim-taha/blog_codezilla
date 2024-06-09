@extends('layouts.app')

@section('title')
    Edit Post
@endsection

@section('content')



    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('posts.update', $post->slug) }}">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input name="title" type="text" value="{{ old('title') ?? $post->title }}" class="form-control">
        </div>
        <div class="mb-3">
            <label  class="form-label">Description</label>
            <textarea name="description" class="form-control" rows="3">{{ $post->description }}</textarea>
        </div>

        <div class="mb-3">
            <label  class="form-label">Post Creator</label>
            <select name="user_id" class="form-control">
                @foreach ($users as $user)
                    <option @selected($user->id == $post->user_id) value="{{ $user->id }}" >{{ $user->name }}</option>
                @endforeach
            </select>
        </div>

        <button class="btn btn-warning">Update</button>
    </form>

    @endsection
