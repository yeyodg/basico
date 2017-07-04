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
        $post->likes = 0;
        $post->dislikes = 0;
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
        $post = Post::find($post_id);
        if(!$post) return null;
        $user = Auth::user();

        $like = $post->likes()->where('user1_id', $user->id)->first();

        //Si hay un like/dislike del usuario 
        if ($like) {
           $already_like = $like->like;
           $update = true;
           //Si el like/dislike es igual al click
           if ($already_like == $is_like) {
                //Disminuir Like/Dislike
               if($is_like) $post->likes--;
               else $post->dislikes--;
               $post->update();
               $like->delete();
               return response()->json([
                'respuesta' => 'Borrado',
                'post_likes' => $post->likes,
                'post_dislikes' => $post->dislikes
                ],200);
           } else{
                $like->like = $is_like;
                if($is_like) {
                    $post->dislikes--;
                    $post->likes++;
                }
                else {
                    $post->dislikes++;
                    $post->likes--;
                }
                $post->update();
                $like->update();
                return response()->json([
                 'respuesta' => 'Combiado',
                 'post_likes' => $post->likes,
                 'post_dislikes' => $post->dislikes
                 ],200);
           }
        } else {
           $like = new Like();
        }
        if($is_like) $post->likes++;
        else $post->dislikes++;
        $post->update();
        $like->like = $is_like;
        $like->user1_id = $user->id;
        $like->post_id = $post_id;
        $like->save();
        return response()->json([
            'respuesta' => 'Hecho',
            'post_likes' => $post->likes,
            'post_dislikes' => $post->dislikes
            ],200);
    }

}
