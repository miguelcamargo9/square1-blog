<?php

namespace App\Http\Controllers;

use App\Models\Post;

use Illuminate\Http\Request;

class PostsController extends Controller
{
    public function index($order)
    {
        return Post::with("user")->orderBy('publication_date', $order)->get();
    }

    public function show($idPost)
    {
        return empty(Post::find($idPost)) ? [] : Post::with("user")->find($idPost);
    }

    public function store(Request $request)
    {
        $input = $request->all();
        $user = $request->user();
        $input['user_id'] = $user->id;
        $input['publication_date'] = date("Y-m-d H:i:s");
        $post = Post::create($input);

        return response()->json($post, 201);
    }

    public function dateRagePost(Request $request)
    {
        $input = $request->all();
        return Post::with("user")->whereBetween('publication_date', [$input["start_date"], $input["final_date"]])->get();
    }

    public function update(Request $request, Post $post)
    {
        $post->update($request->all());

        return response()->json($post, 200);
    }

    public function delete(Post $post)
    {
        $post->delete();

        return response()->json(null, 204);
    }

    public function postByUser(Request $request)
    {
        $user = $request->user();
        return Post::with("user")->where("user_id", $user->id)->get();
    }
}
