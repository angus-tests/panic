<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(Request $request): View
    {
        $reports = Report::orderBy('created_at', 'desc')->get();
        $apiKey = env('GOOGLE_API_KEY');

        return view('welcome', [
            'reports' => $reports,
            'apiKey' => $apiKey
        ]);
    }
}
