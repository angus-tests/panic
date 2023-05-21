<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        return view('welcome', [
            'reports' => [
                ["name" => "Bob", "location" => "London", "time" => "12:45"],
                ["name" => "Charlie", "location" => "Essex", "time" => "15:05"],
                ["name" => "Dave", "location" => "Sheffield", "time" => "19:12"]
            ]
        ]);
    }
}
