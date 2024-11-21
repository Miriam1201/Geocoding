<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CityController extends Controller
{
    public function index()
    {
        return City::with('state')->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'state_id' => 'required|exists:states,id',
        ]);

        $city = City::create($validated);

        return response()->json($city, Response::HTTP_CREATED);
    }

    public function show(City $city)
    {
        if (!$city) {
            return response()->json(['error' => 'resource not found'], 404);
        }
        return $city->load('state');
    }

    public function update(Request $request, City $city)
    {
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'state_id' => 'sometimes|exists:states,id',
        ]);

        $city->update($validated);

        return response()->json($city, Response::HTTP_OK);
    }

    public function destroy($id)
    {
        $city = City::find($id);

        if (!$city) {
            return response()->json(['error' => 'City not found'], 404);
        }

        $city->delete();

        return response()->json(['message' => 'City deleted successfully']);
    }
}
