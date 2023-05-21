<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Store a new report in the database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required',
            'lat' => 'required',
            'long' => 'required',
        ]);


        // Create a new report associated with the panic button press
        Report::create([
            'name' => $validatedData['name'],
            'long' =>  $validatedData['long'],
            'lat' =>  $validatedData['lat']
        ]);

        // Return a 201 response
        return response(null, 201);
    }
}
