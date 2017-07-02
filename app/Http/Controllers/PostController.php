<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
    public function getDashboard()
    {
        return view('dashboard');
    }
    public function postCreatePost(Request $request)
    {
    	$this->validate($request, [
    			'body' => 'required|max:1000'
    		]);
    	$post = new Post();
    	$post->body = $request['body'];
    	$message = 'There was an error';
    	if($request->user()->posts()->save($post)){
    	$message = 'Post successfully created!';
    	}
    	return redirect()->route('dashboard')->with(['message' => $message]);
    }
}
