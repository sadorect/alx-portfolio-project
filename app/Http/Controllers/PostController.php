<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function allPosts(){
        return view('posts.all_post');
    }

    public function addPost(){
        return view('posts.add_post');
    }

    public function editPosts(){
        return view('posts.edit_post');
    }

    public function deletePost(){
        return redirect()->back();
    }

    public function updatePost(){
        return redirect()->back();
    }
}
