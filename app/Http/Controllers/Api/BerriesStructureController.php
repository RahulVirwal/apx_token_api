<?php

namespace App\Http\Controllers\Api;

use App\Models\BerriesStructure;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BerriesStructureController extends Controller
{
    public function index() { return BerriesStructure::all(); }

    public function store(Request $request) {
        $validated = $request->validate([
            'description' => 'required',
            'berry_type' => 'required',
            'farm_code' => 'required',
            'batch_id' => 'required',
            'harvest_date' => 'required|date',
            'quantity_grams' => 'required|integer',
            'certifications' => 'nullable|array',
            'carbon_offset_kg' => 'required|numeric',
            'grower' => 'required',
            'traceability_qr' => 'required',
            'current_owner' => 'required',
            'utility_tags' => 'nullable|array'
        ]);
        return BerriesStructure::create($validated);
    }

    public function show($id) { return BerriesStructure::findOrFail($id); }

    public function update(Request $request, $id) {
        $berries = BerriesStructure::findOrFail($id);
        $validated = $request->validate([
            'description' => 'sometimes',
            'berry_type' => 'sometimes',
            'farm_code' => 'sometimes',
            'batch_id' => 'sometimes',
            'harvest_date' => 'sometimes|date',
            'quantity_grams' => 'sometimes|integer',
            'certifications' => 'nullable|array',
            'carbon_offset_kg' => 'sometimes|numeric',
            'grower' => 'sometimes',
            'traceability_qr' => 'sometimes',
            'current_owner' => 'sometimes',
            'utility_tags' => 'nullable|array'
        ]);
        $berries->update($validated);
        return $berries;
    }

    public function destroy($id) { return BerriesStructure::destroy($id); }
}
