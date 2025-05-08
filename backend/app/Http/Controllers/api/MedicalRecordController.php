<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MedicalRecord;

class MedicalRecordController extends Controller
{
    /**
     * Display a listing of all medical records.
     */
    public function index()
    {
        return response()->json(MedicalRecord::all());
    }

    /**
     * Store a newly created medical record in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'patient_id'  => 'required|exists:patients,id',
            'visit_date'  => 'required|date',
            'diagnosis'   => 'required|string',
            'prescription' => 'required|string',
        ]);

        $record = MedicalRecord::create($validated);

        return response()->json($record, 201);
    }

    /**
     * Display the specified medical record.
     */
    public function show($id)
    {
        $record = MedicalRecord::findOrFail($id);
        return response()->json($record);
    }

    /**
     * Update the specified medical record in storage.
     */
    public function update(Request $request, $id)
    {
        $record = MedicalRecord::findOrFail($id);

        $validated = $request->validate([
            'visit_date'   => 'sometimes|required|date',
            'diagnosis'    => 'sometimes|required|string',
            'prescription' => 'sometimes|required|string',
        ]);

        $record->update($validated);

        return response()->json($record);
    }

    /**
     * Remove the specified medical record from storage.
     */
    public function destroy($id)
    {
        $record = MedicalRecord::findOrFail($id);
        $record->delete();

        return response()->json(null, 204);
    }

    /**
     * Get all medical records for a specific patient.
     */
    public function getByPatient($patientId)
    {
        $records = MedicalRecord::where('patient_id', $patientId)->get();
        return response()->json($records);
    }
}
