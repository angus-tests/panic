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

        return $version;
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
        }else{

            // Remove any trailing 0's but preserve non 0 decimals
            $version = number_format($version, ($version != intval($version)) ? 2 : 0);
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
