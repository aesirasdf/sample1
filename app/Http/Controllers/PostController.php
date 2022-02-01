<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    //
    public function __construct(){
        $this->middleware("auth");
    }

    public function index(){
        $Posts = Post::orderBy("created_at", "desc")->get();
        return view("posts.index", compact(['Posts']));
    }

    public function store(Request $request){
        if(auth()->user()->Profile){
            $data = $this->validate($request, [
                "message" => "required",
            ]);
            auth()->user()->Posts()->Create($data);
        }
        else{
            return abort(403);
        }
        return redirect()->route("posts-index");
    }

    public function destroy($id){
        $post = Post::find($id);
        if(is_null($post))
            abort(404);
        else if($post->user_id == auth()->user()->id){
            $post->delete();
        }
        else{
            abort(403);
        }
        return redirect()->route("posts-index");
    }
}
