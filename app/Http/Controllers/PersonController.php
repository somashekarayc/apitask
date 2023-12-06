<?php

namespace App\Http\Controllers;

use App\Models\Person;
use App\Models\Scan;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
// use Revolution\Google\Sheets\Facades\Sheets;
use Revolution\Google\Sheets\Facades\Sheets;
// use Sheets;

class PersonController extends Controller
{
    public function fetchAndUpdate(Request $request)
    {
        $sheet = Sheets::spreadsheet('1SJx5WXWBElw5D008VpBiTpMABezStyIL7PR1a8Y397w')->sheet('persons')->get();

        $header = $sheet->pull(0);
        $values = Sheets::collection(header: $header, rows: $sheet);
        $values->toArray();

        // dd($values);
        // $data = $sheet->all();

        foreach ($values as $row) {
            $person = Person::where('id', $row['id'])->first();

            if (!$person) {
                $person = new Person([
                    'name' => $row['name'],
                    'bus_number' => $row['bus_number'],
                ]);

                $person->save();
            }
        }

        return response()->json(['message' => 'Data fetched and updated successfully'], 200);
    }
    public function updateScan(Request $request)
    {
        $sheet = Sheets::spreadsheet('1SJx5WXWBElw5D008VpBiTpMABezStyIL7PR1a8Y397w')->sheet('scans')->get();
        $header = $sheet->pull(0);
        $values = Sheets::collection(header: $header, rows: $sheet);
        $values->toArray();

        $scannedPersons = 0;
        $missingPersons = 0;

        foreach ($values as $row) {
            $person = Person::find($row['person_id']);
            $scan = new Scan();
            if ($person) {
                $scan->person_id = $person->id;
                $scan->scanned_at = Carbon::now();
                $scan->save();
                $scannedPersons++;
                // return response()->json(['message' => 'Student scanned successfully!']);
            } else {
                $missingPersons++;
                // return response()->json(['message' => 'Student not found!'], 404);

            }
        }

        return response()->json([
            'message' => 'Persons scan updated successfully!',
            'total_scanned_persons' => $scannedPersons,
            'total_missing_persons' => $missingPersons,
        ]);
    }


    public function fetchMissingPersons()
    {
        $missingPersons = Person::whereDoesntHave('scans')->get();

        return response()->json($missingPersons);
    }



    public function index()
    {
    }
    public function store(Request $request)
    {
    }
    public function show($id)
    {
    }
}

