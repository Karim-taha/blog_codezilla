<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;


class PostController extends Controller
{
    public function index(){
        $posts = Post::all();  // return collection object.
        return view('posts.index', ["posts" => $posts]);
    }

    public function show($slug){

        // $post = Post::find($id);  // return model object and work with only id
        $post = Post::where('slug', $slug)->first();  // return model object limit 1
        // $post = Post::where('slug', 'php')->get();   // return collection object and all rows that have slug = php
        // dd($post);
        if(is_null($post)){
            return to_route('posts.index');
        }
        return view('posts.show', ['post' => $post]);
    }

    public function create(){
        $users = User::all();
        return view('posts.create', ['users' => $users]);
    }

    public function store(){

        // $postData = request()->all();
        // $post = new Post();
        // $post->title = request()->title;
        // $post->description = request()->description;
        // $post->slug = Str::slug(request()->title, "-");
        // // dd($postData);
        // $post->save();

        request()->validate([
            'title' => 'required|min:3',
            'description' => 'required',
            'slug' => Str::slug(request('title'), "-"),
            'user_id' => 'required|integer|exists:users,id',
        ]);

        Post::create([
            'title' => request()->title,
            'description' => request()->description,
            'slug' => Str::slug(request()->title, "-"),
            'user_id' => request()->user_id
        ]);

        return redirect()->route('posts.index');
    }

    public function edit($slug){
        $post = Post::where('slug', $slug)->first();
        $users = User::all();
        return view('posts.edit', ["post" => $post, "users" => $users]);
    }

    public function update($slug){

        $post = Post::where('slug', $slug)->first();
        // dd($post);
        request()->validate([
            'title' => 'required|min:3',
            'description' => 'required',
            'slug' => Str::slug(request('title'), "-"),
            'user_id' => 'required|integer|exists:users,id',
        ]);

        $post->update([
            'title' => request()->title,
            'description' => request()->description,
            'slug' => Str::slug(request()->title, "-"),
            'user_id' => request()->user_id
        ]);

        return to_route('posts.show', $post->slug);
    }

    public function destroy($id){

        $post = Post::findorFail($id);
        $post->delete();
        return to_route('posts.index');
    }

}
