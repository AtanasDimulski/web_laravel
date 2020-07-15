<?php

namespace App\Http\Controllers;

use App\Post;
use App\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CommentsController extends Controller
{
    public function index()
    {

    }

    public function show($id)
    {

    }

    public function create()
    {

    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'qoute' => 'required',
        ]);

        //Create coment
        $comment = new Comment();
        $id = $request->input('post_id');
        $comment->qoute = $request->input('qoute');
        $comment->user_id = auth()->user()->id;
        $comment->comment_name = auth()->user()->name;
        $comment->post_id = $request->input('post_id');
        $comment->comment_picture = auth()->user()->profile_picture;

        // Post comment into database
        $comment->save();

        //redirect back to posts page after posting comment
        return redirect('/posts/'.$id)->with('success','Comment Posted');
    }

    public function edit($id)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }
}
