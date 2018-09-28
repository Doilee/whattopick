<?php

namespace App\Http\Controllers;

use App\Champion;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        return view('welcome')
            ->with('champions', Champion::all()->sortBy('name'))
            ->withErrors($request->get('main'));
    }
}
