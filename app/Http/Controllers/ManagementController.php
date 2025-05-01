<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManagementController extends Controller
{
    public function showUploadForm()
    {
        return view('upload');
    }

    public function uploadLocations(Request $request)
    {
        $request->validate([
            'location_file' => 'required|file|mimes:csv,txt|max:2048'
        ]);

        try {
            $file = $request->file('location_file');
            $fileContent = file_get_contents($file->getPathname());

            $lines = explode("\n", $fileContent); // Ubah dari explode(';') jadi newline
            array_shift($lines); // Hilangkan header
            $lines = array_filter($lines); // Hilangkan baris kosong

            DB::beginTransaction();

            $id = 1;

            foreach ($lines as $line) {
                $line = trim($line);
                if (empty($line)) continue;

                // Hapus tanda ';' di akhir baris, lalu split
                $line = rtrim($line, ';');
                list($lat, $long) = explode(',', $line);

                // Lakukan update
                DB::table('locations')
                    ->where('id', $id)
                    ->update([
                        'latitude' => trim($lat),
                        'longitude' => trim($long)
                    ]);

                $id++;
            }

            DB::commit();
            return redirect()->back()->with('success', 'Locations updated successfully!');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'Error updating locations: ' . $e->getMessage());
        }
    }

    // public function uploadLocations(Request $request)
    // {
    //     // Validate the uploaded file
    //     $request->validate([
    //         'location_file' => 'required|file|mimes:csv,txt|max:2048'
    //     ]);

    //     try {
    //         // Get the uploaded file
    //         $file = $request->file('location_file');

    //         // Read file content
    //         $fileContent = file_get_contents($file->getPathname());

    //         // Split content into lines
    //         $lines = explode('\n', $fileContent);

    //         // Remove header
    //         array_shift($lines);

    //         // Remove empty lines
    //         $lines = array_filter($lines);

    //         // Counter for ID
    //         $id = 1;

    //         DB::beginTransaction();

    //         foreach ($lines as $line) {
    //             // Skip empty lines
    //             if (empty(trim($line))) {
    //                 continue;
    //             }

    //             // Parse the line
    //             list($lat, $long) = explode(',', trim($line));

    //             // Update location record
    //             DB::table('locations')
    //                 ->where('id', $id)
    //                 ->update([
    //                     'latitude' => trim($lat),
    //                     'longitude' => trim($long)
    //                 ]);

    //             $id++;
    //         }

    //         DB::commit();

    //         return redirect()->back()->with('success', 'Locations updated successfully!');

    //     } catch (\Exception $e) {
    //         DB::rollBack();
    //         return redirect()->back()->with('error', 'Error updating locations: ' . $e->getMessage());
    //     }
    // }
}
