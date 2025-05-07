<?php

namespace App\Http\Controllers\Api;

use App\Models\Service;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ServiceController extends Controller
{
    public function index()
    {
        return Service::all();
    }
    public function store(Request $request)
    {
        return Service::create($request->validate(['name' => 'required']));
    }
    public function show($id)
    {
        return Service::findOrFail($id);
    }
    public function update(Request $request, $id)
    {
        $service = Service::findOrFail($id);
        $service->update($request->all());
        return $service;
    }
    public function destroy($id)
    {
        return Service::destroy($id);
    }
}
