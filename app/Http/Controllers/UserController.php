<?php

namespace App\Http\Controllers;

use App\Exports\UsersExport;
use App\Imports\UserImport;
use App\Imports\UsersImport;
use App\Models\User;
use Excel;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index', [
            // we will display a list of user data on the index page
            'users' => User::all(),
       ]);
    }

    public function export()
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }

    public function import(Request $request)
    {
        // use Excel facade to import data, by passing in the UserImport class and the uploaded file request as arguments
        Excel::import(new UserImport, $request->file('file')->store('temp'));

        return redirect('/')->with('success', 'All good!');
    }

}
