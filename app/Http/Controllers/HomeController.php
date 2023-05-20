<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        return view('welcome', [
            'reports' => ["Report1", "Report2", "Report3"],
        ]);
    }
}
