<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use Illuminate\Http\Request;
use Auth;
use App\Post;
use App\Like;
use App\Comment;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function CreatePost(){
        return view('create_post');
    }

    public function Posting(PostRequest $request){
        $post = new post();
        $post->caption = $request->input('caption');
        $post->photo_type = 'none';
        if($request->hasFile('photo')){
            $image = $request->file('photo');
            $ext = $image->getClientOriginalExtension();
            $post->photo_type = 'photo';
            if($ext=='mp4'){
                $post->photo_type = 'video';
            }
            $imageName = uniqid(str_random(5),true).'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads'),$imageName);
            $post->photo = $imageName;
        }
        $post->user_id = auth::user()->id;
        $post->save();
        return redirect()->route('home');
    }

    public function Comment(Request $request, $post_id){
      $comment = new comment();
      $comment->comment = $request->input('comment');
      $comment->post_id = $post_id;
      $comment->user_id = auth::user()->id;
      $comment->save();
      // if($comment->save()){
      //   return response()->json('Success');
      // }else{
      //   return response()->json('Fail');
      // }
      return redirect()->route('home');
    }

    public function Like($post_id){
        $like = Like::where('user_id',auth::user()->id)->where('post_id',$post_id)->first();

        if($like){
            $like->delete();
        }else{
            $like = new like();
            $like->post_id = $post_id;
            $like->user_id = auth::user()->id;
            $like->save();
        }
        return redirect()->route('home');
    }

    public function Update($post_id){
        $data = Post::findOrFail($post_id);
        return view('update_post',compact('data'));
    }

    public function StoreUpdate(Request $request){
      $post = Post::findOrFail($request->input('id'));
      $post->caption = $request->input('caption');
      $post->photo_type = 'none';
      if($request->hasFile('photo')){
        $image = $request->file('photo');
        $ext = $image->getClientOriginalExtension();
        $post->photo_type = 'photo';
        if($ext=='mp4'){
            $post->photo_type = 'video';
        }
        $imageName = uniqid(str_random(5),true).'.'.$image->getClientOriginalExtension();
        $image->move(public_path('uploads'),$imageName);
        $post->photo = $imageName;
      }
      $post->save();
      return redirect()->route('home');
    }

    public function Delete($post_id){
        $post = Post::findOrFail($post_id);
        $post->delete();
        return redirect()->route('home');
    }
}
