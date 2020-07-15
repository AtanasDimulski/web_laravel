<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Comment;

class PostsController extends Controller
{
    //

    public function index()
    {
        $data = array(
            'news' =>  Post::orderBy('created_at','desc')->paginate(6),
        );
        return view('pages.overview')->with($data);
    }

    public function show($id)
    {
        $data = array(
            'post'=>  Post::find($id),
            'comments' => Comment::orderBy('created_at','desc')->get(),
        );

        return view('posts.show')->with($data);
    }

    public function create()
    {
        if (Gate::allows('admins-only', Auth::user())) {
            return view('posts.create');
        }
        else
        {
            return redirect('/')->with('error','unauthorized access');
        }
    }

    public function store(Request $request)
    {
        if (Gate::allows('admins-only', Auth::user())) {


            $this->validate($request, [
                'title' => 'required',
                'author' => 'required',
                'body' => 'required',
                'cover_image' => 'image|nullable|max:1999'
            ]);

            //Handle file upload for Blog image
            if($request->hasFile('cover_image'))
            {
                // Get file name with the extension
                $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();

                // Get just file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

                // Get just ext
                $extension = $request->file('cover_image')->getClientOriginalExtension();

                // File name to store
                $fileNameToStore  = $fileName.'_'.time().'.'.$extension;

                // Upload Image
                $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            }
            else
            {
                $fileNameToStore = 'noimage.jpg';
            }

            // Handle file upload for cover image
            if($request->hasFile('overview_image'))
            {
                // Get file name with the extension
                $overviewFileNameWithExt = $request->file('overview_image')->getClientOriginalName();

                // Get just file name
                $overviewFileName = pathinfo($overviewFileNameWithExt, PATHINFO_FILENAME);

                // Get just ext
                $overviewExtension = $request->file('overview_image')->getClientOriginalExtension();

                // File name to store
                $overviewFileNameToStore  = $overviewFileName.'_'.time().'.'.$overviewExtension;

                // Upload Image
                $path = $request->file('overview_image')->storeAs('public/cover_images', $overviewFileNameToStore);
            }
            else
            {
                $overviewFileNameToStore = 'noimage.jpg';
            }

            //Create post
            $post = new Post;
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            $post->author = $request->input('author');
            $post->cover_image = $fileNameToStore;
            $post->overview_image = $overviewFileNameToStore;

            // Post data into database
            $post->save();

            //redirect back to posts page after create
            return redirect('/posts')->with('success','Post Created');
        }
        else
        {
            return redirect('/')->with('error','unauthorized access');
        }
    }

    public function edit($id)
    {
        if (Gate::allows('admins-only', Auth::user())) {
            $post = Post::find($id);
            return view('posts.edit')->with('post',$post);
        }
        else
        {
            return redirect('/')->with('error','unauthorized access');
        }
    }

    public function update(Request $request, $id)
    {
        if (Gate::allows('admins-only', Auth::user())) {

            $this->validate($request, [
                'title' => 'required',
                'author' => 'required',
                'body' => 'required'
            ]);

            //Handle file upload for Blog image
            if($request->hasFile('cover_image'))
            {
                // Get file name with the extension
                $fileNameWithExt = $request->file('cover_image')->getClientOriginalName();

                // Get just file name
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);

                // Get just ext
                $extension = $request->file('cover_image')->getClientOriginalExtension();

                // File name to store
                $fileNameToStore  = $fileName.'_'.time().'.'.$extension;

                // Upload Image
                $path = $request->file('cover_image')->storeAs('public/cover_images', $fileNameToStore);
            }

            // Handle file upload for cover image
            if($request->hasFile('overview_image'))
            {
                // Get file name with the extension
                $overviewFileNameWithExt = $request->file('overview_image')->getClientOriginalName();

                // Get just file name
                $overviewFileName = pathinfo($overviewFileNameWithExt, PATHINFO_FILENAME);

                // Get just ext
                $overviewExtension = $request->file('overview_image')->getClientOriginalExtension();

                // File name to store
                $overviewFileNameToStore  = $overviewFileName.'_'.time().'.'.$overviewExtension;

                // Upload Image
                $path = $request->file('overview_image')->storeAs('public/cover_images', $overviewFileNameToStore);
            }

            //Create post
            $post =  Post::find($id);
            $post->title = $request->input('title');
            $post->body = $request->input('body');
            $post->author = $request->input('author');
            if($request->hasFile('cover_image')){
                $post->cover_image = $fileNameToStore;
            }
            if($request->hasFile('overview_image')){
                $post->overview_image = $overviewFileNameToStore;
            }

            // Post data into database
            $post->save();

            //redirect back to posts page after create
            return redirect('/posts')->with('success','Post Updated');
        }
        else
        {
            return redirect('/')->with('error','unauthorized access');
        }

    }

    public function destroy($id)
    {
        if (Gate::allows('admins-only', Auth::user())) {

            $post = Post::find($id);
            //check if post has images to delete
            if($post->cover_image != 'noimage.jpg'){
                //delete Image
                Storage::delete('public/cover_images/'.$post->cover_image);
            }
            if($post->overview_image != 'noimage.jpg'){
                //delete Image
                Storage::delete('public/cover_images/'.$post->overview_image);
            }
            $post->delete();

            return redirect('/posts')->with('success','Post Removed');
        }
        else
        {
            return redirect('/')->with('error','unauthorized access');
        }

    }

}
