<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Exports\UsersExport;

use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PDF;
class ExportController extends Controller
{
    //
    public function export()
    {
        if (Gate::allows('admins-only', Auth::user())) {
            return Excel::download(new UsersExport, time().'users.xlsx');
        }
        else
        {
            return redirect('/')->with('error','unauthorized access');
        }
    }

    public function topdf($id) {

        $data = array(
            'post'=>  Post::find($id),
            'comments' => Comment::orderBy('created_at','desc')->get(),
        );
        $pdf = PDF::loadView('posts.postpdf', $data);

        $pdf->save(storage_path().'_filename.pdf');
        return $pdf->download('invoice.pdf');
    }
}
