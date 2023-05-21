<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FirmwareController extends Controller
{
    /**
     * Return the current firmware version
     */
    public function version(Request $request): \Illuminate\Http\JsonResponse
    {
        $version = config('app.firmware_version');
        
        return response()->json(['version' => $version]);
    }
}
