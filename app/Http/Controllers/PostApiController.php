<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\Post as PostResource;
use Illuminate\Http\Request;
use App\Http\Requests;

class PostApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //get all api articles
        $articles = Post::paginate(3);

        //return the collection of posts as a resource
        return PostResource::collection($articles);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Image::configure(array('driver' => 'imagick'));
        $this->validate($request, [
            'title' => 'required',
            'author' => 'required',
            'body' => 'required',
            'cover_image' => 'image|nullable|max:1999'
        ]);


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
        //
        $article = $request->isMethod('put') ? Post::findorfail
        ($request->id) : new Post();

        $article->id = $request->input('id');
        $article->title = $request->input('title');
        $article->body = $request->input('body');
        $article->author = $request->input('author');
        $article->cover_image = $fileNameToStore;
        $article->overview_image = $overviewFileNameToStore;

        if($article->save()){
            //return new PostResource($article);

            //return to overview page
            return redirect('/posts')->with('success','Post Created');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //show a single post
        $article = Post::findorfail($id);

        //return the single post as a resource
        return new PostResource($article);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //find a single post
        $article = Post::findorfail($id);

        //delete the single post
        if($article->delete()){

            return response()->json(null,200);
        }
    }
}
