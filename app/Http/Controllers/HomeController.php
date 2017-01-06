<?php

namespace App\Http\Controllers;

use App\Champion;
use Illuminate\Http\Request;
use App\Http\Controllers\ApiController;
use Collective\Html\HtmlFacade;

class HomeController extends Controller
{

    public function index()
    {
        return view('welcome')
            ->with('champions', Champion::all()->sortBy('name'));
    }
}
