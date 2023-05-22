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
        return response()->json(['version' => floatval($version)]);
    }

    /**
     * Dont return a JSON response
     */
    public function versionRaw(Request $request)
    {
        $version = config('app.firmware_version');

        // Set the response headers
        $headers = [
            'Content-Type' => 'text/plain',
            'Content-Disposition' => 'attachment; filename="version.txt"',
        ];

        // Return the file content as a response
        return response($version, 200, $headers);
    }

    /**
     * Download firmware endpoint
     */
    public function download($version="latest")
    {

        // Get the latest firmware
        if ($version === "latest") {

            $latestVersion = config('app.firmware_version');
            $firmwareFiles = glob(public_path('firmware/*.bin'));

            // Attempt to find the biggest firmware version
            foreach ($firmwareFiles as $file) {
                $filename = basename($file);
                $fileVersion = (int) pathinfo($filename, PATHINFO_FILENAME);

                if ($fileVersion > $latestVersion) {
                    $latestVersion = $fileVersion;
                }
            }

            $version = $latestVersion;
        }

        // Attempt to find the binary in the public folder
        $filename = $version . '.bin';

        $filePath = public_path('firmware/' . $filename);

        if (file_exists($filePath)) {
            return response()->file($filePath);
        } else {
            // Handle case when the firmware file does not exist
            abort(404, 'Firmware not found');
        }
    }
}
