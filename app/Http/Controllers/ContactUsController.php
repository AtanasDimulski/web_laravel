<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\ContactUs;
use Mail;

class ContactUsController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function contactUs()
    {
        return view('contactUs');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = array(
            'contactUs' =>  Contactus::orderBy('id','desc')->paginate(6),
        );
        return view('contactUs')->with($data);
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required'
        ]);

        ContactUs::create($request->all());
        Mail::send('email',
            array(
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'user_message' => $request->get('message')
            ), function($message)
            {
                $message->from('techanical-atom@gmail.com');
                $message->to('laravel1231@gmail.com', 'Admin')
                    ->subject('Contact Form Query');
            });
        return back()->with('success', 'Thanks for contacting us!');
    }
}
