<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Post;
use App\User;
use Illuminate\Http\Request;
use App\Admin;

class PagesController extends Controller
{
    public function index(){

        $data = array(
            'posts' => Post::orderBy('created_at','desc')->get(),
            'adminCodes' => Admin::orderBy('created_at','desc')->get(),
            'users' => User::orderBy('created_at','desc')->get(),
            'comments' => Comment::orderBy('created_at','desc')->get()
        );
        return view('home')->with($data);

    }

    public function overview(){
        $data = array(
            'title' => 'Blog overviews edited',
            'sports' => ['Football', 'Basketball', 'Hockey']
        );
        return view('pages.overview')->with($data);
    }

    public function main(){
        return view('welcome');
    }

    public function blog(){
        return view('pages.blogmain');
    }

    public function about(){
        return view('pages.about');
    }
}
