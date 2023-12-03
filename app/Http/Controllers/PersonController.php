<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;
use Revolution\Google\Sheets\Facades\Sheets;

class PersonController extends Controller
{
    public function fetchAndUpdate(Request $request)
    {
        $sheet = Sheets::spreadsheet(config('google-sheets.spreadsheet_id'))->sheet(config('google-sheets.sheet_name'));
        $data = $sheet->all();

        foreach ($data as $row) {
            $person = Person::where('name', $row['name'])->firstOrCreate([
                'name' => $row['name'],
                'bus_number' => $row['bus_number'],
            ]);

            $person->scanned_at = $row['scanned_at'];
            $person->save();
        }

        return response()->json(['message' => 'Data fetched and updated successfully'], 200);
    }
}
