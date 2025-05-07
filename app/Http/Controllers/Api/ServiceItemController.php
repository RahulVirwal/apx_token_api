<?php
namespace App\Http\Controllers\Api;

use App\Models\ServiceItem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceItemController extends Controller
{
    public function index() { return ServiceItem::all(); }
    public function getByServiceId($id) { return ServiceItem::where('service_data', $id)->get(); }
    public function store(Request $request) {
        $validated = $request->validate([
            'service_data'=>'required|exists:services,id',
            'name'=>'required',
            'description'=>'nullable',
            'image'=>'nullable|file'
        ]);
        if ($request->hasFile('image')) { $validated['image'] = $request->file('image')->store('uploads'); }
        return ServiceItem::create($validated);
    }
    public function show($id) { return ServiceItem::findOrFail($id); }
    public function update(Request $request, $id) {
        $item = ServiceItem::findOrFail($id);
        $validated = $request->validate([
            'service_data'=>'sometimes|exists:services,id',
            'name'=>'sometimes',
            'description'=>'nullable',
            'image'=>'nullable|file'
        ]);
        if ($request->hasFile('image')) { $validated['image'] = $request->file('image')->store('uploads'); }
        $item->update($validated);
        return $item;
    }
    public function destroy($id) { return ServiceItem::destroy($id); }
}
