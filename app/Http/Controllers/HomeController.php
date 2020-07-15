<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Image;

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

        $data = array(
            'news' =>  Post::orderBy('created_at','desc')->paginate(6),
        );
        return view('pages.overview')->with($data);
    }

    public function edit($id)
    {
        $post = User::find($id);
        return view('profile.edit')->with('post',$post);
    }
    public function update(Request $request,$id)
    {
        Image::configure(array('driver' => 'imagick'));
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required',
        ]);

        if($request->hasFile('profile_picture')){
            $profile_picture = $request->file('profile_picture');
            $filename = time().'.'.$profile_picture->getClientOriginalExtension();

            //circle the image
            $profile_picture = Image::make($profile_picture);


            $profile_picture->mask(public_path('storage/profile_pictures/mask_star.png'), true);

            if (Auth::user()->profile_picture !== 'profile_default.jpg') {
                $file = public_path('storage/profile_pictures/' . Auth::user()->profile_picture);
                //This is where the file is deleted
                Storage::delete('public/profile_pictures/'.Auth::user()->profile_picture);
                Storage::delete('public/profile_pictures/'.'pixel'.Auth::user()->profile_picture);

            }
            Image::make($profile_picture)->resize(300,300)->save(public_path('storage/profile_pictures/'.$filename));

            //pixalation of picture here
            $watermark  = Image::make(public_path('storage/profile_pictures/watermark.png'))->resize(300,300);
            $watermark->opacity(70);
            $pixel = 'pixel'.$filename;
            Image::make($profile_picture)->resize(300,300)->pixelate(15)->insert($watermark,'center')->save(public_path('storage/profile_pictures/'.$pixel));


        }
        else
        {
            $filename = Auth::user()->profile_picture;
        }

        //Create post
        $post = User::find($id);
        $post->name = $request->input('name');
        $post->email = $request->input('email');
        $post->profile_picture = $filename;


        // Post data into database
        $post->save();

        //redirect back to posts page after create
        return redirect('/profile/show')->with('success','User details updated');
    }

    public function picture(Request $request, $id){
            return 'mwahahaha';
    }

    public function show()
    {
        $user_id = Auth::user()->id;
        $user = User::find($user_id);
        $datas = array(
            'user' => Auth::user(),
            //shows comments for only that user due to the model relationship
            'comments' => $user->comments,
        );
        return view('profile.show')->with($datas);
    }

    public function store(Request $request)
    {}

    public function destroy(Request $request,$id)
    {

        $type = $request->input('type');
        if($type == 1)
        {
            $post = User::find($id);
            if($post->profile_picture != 'profile_default.jpg'){
                //delete Image
                Storage::delete('public/profile_pictures/'.$post->profile_picture);
            }
            $post->delete();

            return redirect('/profile/show')->with('success','User Removed');
        }
        elseif($type == 2)
        {
            $comment_id = $id;
            $comment = Comment::find($comment_id);

            $comment->delete();

            return redirect('/profile/show')->with('success','Comment successfully Removed');
        }

    }
}
