<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Gate;
use App\Admin;
use App\Comment;
use App\Post;
use App\User;

class AdminController extends Controller
{
    //
    public function index()
    {
        //Page which only the admin should be able to see
        if (Gate::allows('admins-only', Auth::user())) {
            //show page with all the current available admin codes displayed
            $data = array(
                'posts' => Post::orderBy('created_at','desc')->get(),
                'adminCodes' => Admin::orderBy('created_at','desc')->get(),
                'users' => User::orderBy('created_at','desc')->get(),
                'comments' => Comment::orderBy('created_at','desc')->get()
            );
            return view('home')->with($data);
        }
        else
        {
            return redirect('/')->with('error','unauthorized access');
        }


    }
    public function create()
    {
        if (Gate::allows('admins-only', Auth::user())) {
            return view('admin.create');
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
                'admin_code' => 'required',
                'company_name' => 'required',
            ]);

            // new admin code to database
            $admin_code = new Admin();

            $admin_code->admin_code = $request->input('admin_code');
            $admin_code->company_name = $request->input('company_name');

            //post new admin code to database
            $admin_code->save();

            //redirect back to admin page after create
            return redirect('/')->with('success','new admin code created');
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
                'admin_code' => 'required',
                'company_name' => 'required'
            ]);

            $admin = Admin::Find($id);
            $admin->admin_code = $request->input('admin_code');
            $admin->company_name = $request->input('company_name');




            // Post admin code into database
            $admin->save();

            //redirect back to home page after posting comment
            return redirect('/')->with('success','Admin code updated');
        }
        else
        {
            return redirect('/')->with('error','unauthorized access');
        }

    }

    public function edit($id)
    {
        if (Gate::allows('admins-only', Auth::user())) {
            $admin = Admin::Find($id);
            return view('admin.edit')->with('admin',$admin);
        }
        else
        {
            return redirect('/')->with('error','unauthorized access');
        }

    }

    public function show()
    {

    }

    public function destroy(Request $request, $id)
    {
        if (Gate::allows('admins-only', Auth::user())) {
            $type = $request->input('type');
            if($type == 1)
            {
                $unique_id = $request->input('post_id');
                $post = Post::find($unique_id);
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

                return redirect('/')->with('success','Post successfully Removed');
            }
            elseif ($type == 2)
            {
                $comment_id = $request->input('comment_id');
                $comment = Comment::find($comment_id);

                $comment->delete();

                return redirect('/')->with('success','Comment successfully Removed');
            }
            elseif ($type == 3)
            {
                $user_id = $request->input('user_id');
                $user = User::find($user_id);
                if($user->profile_picture != 'profile_default.jpg'){
                    //delete Image
                    Storage::delete('public/profile_pictures/'.$user->profile_picture);
                }
                $user->delete();

                return redirect('/')->with('success','User successfully Removed');
            }
            else
            {
                $admin = Admin::find($id);
                //check if post has images to delete

                $admin->delete();

                return redirect('/')->with('success','Admin Code Removed');
            }
        }
        else
        {
            return redirect('/')->with('error','unauthorized access');
        }


    }

}
