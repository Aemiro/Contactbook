<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
class PostController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    public function showAllPosts(){
        return response()->json(Post::all());
    }
    public function showOnePost($id){
        return response()->json(Post::find($id));
    }
    public function create(Request $request){
        // Validation
        $this->validate($request,[
            "title"=>"required",
            "description"=>"required"
        ]);
        // Insert to database
        $article=Post::create($request->all());
        return response()->json($article, 201);
    }
    public function update($id, Request $request){
        // Validation
        $this->validate($request,[
            "title"=>"required",
            "description"=>"required"
        ]);
        $article=Post::findOrFail($id);
        $article->update($request->all());
        return response()->json($article, 200);
    }
    public function delete($id){
        Post::findOrFail($id)->delete();
        return response("Post Deleted!", 200);
    }
  
}
