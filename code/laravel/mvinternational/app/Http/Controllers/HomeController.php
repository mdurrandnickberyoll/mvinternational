<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('mv_international_admin.index');
    }

    public function home()
    {
        return view('mv_international_admin.index');
    }
}
