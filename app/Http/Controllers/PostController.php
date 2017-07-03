<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Post;
use App\Like;

class PostController extends Controller
{
    public function getDashboard()
    {
        $posts = Post::orderBy('created_at', 'dest')->get();
        return view('dashboard',['posts' => $posts]);
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

    public function getDeletePost($post_id)
    {
        $post = Post::where('id',$post_id)->first();
        if(Auth::user() != $post->user1){
            return redirect()->back();
        }
        $post->delete();
        return redirect()->route('dashboard')->with(['message' => 'Successfully deleted!']);
    }

    public function postEditPost(Request $request)
    {
        $this->validate($request, [
            'body' => 'required' 
        ]);
        $post = Post::find($request['postId']);
        if(Auth::user() != $post->user1){
            return redirect()->back();
        }
        $post->body = $request['body'];
        $post->update();
        return response()->json(['new_body' => $post->body],200);
    }

    public function postLikePost(Request $request)
    {
        $post_id = $request['postId'];
        $is_like = $request['isLike'] === 'true';
        $update = false;
        $respuesta = 'Like';
        $post = Post::find($post_id);
        if(!$post) return null;
        $user = Auth::user();
        // $like = $user->likes()->where('post_id', $post_id)->first();
        $like = $post->likes()->where('user_id', $user->id)->first();
        if ($like) {
           $already_like = $like->like;
           $update = true;
           if ($already_like == $is_like) {
               $like->delete();
               $respuesta = 'Borrado';
               return response()->json(['respuesta' => $respuesta],200);
           }
        } else {
           $like = new Like();
        }
        $like->like = $is_like;
        $like->user_id = $user->id;
        $like->post_id = $post_id;
        $like->save();
        // if($update) {$like->update();}
        // else {$like->save();}





        // $like = new Like();
        // $like->like = true;
        // if($like->save()){
        //     $respuesta = 'Guardado';
        // }
        // $like = new Like();
        // $like->post_id = 1;
        // $like->user_id = 1;
        // $like->like = true;
        // $like->save();
        // $respuesta = 'Error';
        // return response()->json(['respuesta' => $respuesta],200);

        return response()->json(['respuesta' => $respuesta],200);
    }


}
