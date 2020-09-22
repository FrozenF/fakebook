<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $post = Post::with(['user','comments.user'])->withCount('likes')->get();
        return view('home',compact('post'));
    }

    public function my_gallery($username){
      $post = Post::whereHas('user', function($query) use ($username){
        $query->where('username',$username);
      })->get();
      return view('my_gallery',compact('post'));
    }
}
