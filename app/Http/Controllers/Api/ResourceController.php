<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Resource;
use App\Models\Category;
use App\Models\SubCategory;
use App\Models\State;
use App\Models\City;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ResourceController extends Controller
{
    /**
     * Display a listing of the resources.
     */
    public function index()
    {
        $resources = Resource::with(['category', 'subcategory', 'state', 'city'])->paginate(10);
        return response()->json($resources);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // This method can return a view if you are using forms on the frontend
        return response()->json([
            'categories' => Category::all(),
            'subcategories' => SubCategory::all(),
            'states' => State::all(),
            'cities' => City::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'address' => 'nullable|string',
            'postal_code' => 'nullable|numeric',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'phone_1' => 'nullable|numeric|digits_between:10,15',
            'phone_2' => 'nullable|numeric|digits_between:10,15',
            'email' => 'nullable|email|max:255',
            'url' => 'nullable|url|max:255',
            'latitude' => 'nullable|numeric|min:-90|max:90',
            'longitude' => 'nullable|numeric|min:-180|max:180',
            'images' => 'nullable|array',
            'images.*' => 'file|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $resource = Resource::create($request->all());

        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('resources-images', 'public');
                $images[] = $path;
            }
            $resource->images = $images;
            $resource->save();
        }

        return response()->json($resource, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Resource $resource)
    {
        if (!$resource) {
            return response()->json(['error' => 'resource not found'], 404);
        }
        $resource->load(['category', 'subcategory', 'state', 'city']);
        return response()->json($resource);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Resource $resource)
    {
        return response()->json([
            'resource' => $resource,
            'categories' => Category::all(),
            'subcategories' => SubCategory::where('category_id', $resource->category_id)->get(),
            'states' => State::all(),
            'cities' => City::where('state_id', $resource->state_id)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Resource $resource)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'sub_category_id' => 'required|exists:sub_categories,id',
            'address' => 'nullable|string',
            'postal_code' => 'nullable|numeric',
            'state_id' => 'required|exists:states,id',
            'city_id' => 'required|exists:cities,id',
            'phone_1' => 'nullable|numeric|digits_between:10,15',
            'phone_2' => 'nullable|numeric|digits_between:10,15',
            'email' => 'nullable|email|max:255',
            'url' => 'nullable|url|max:255',
            'latitude' => 'nullable|numeric|min:-90|max:90',
            'longitude' => 'nullable|numeric|min:-180|max:180',
            'images' => 'nullable|array',
            'images.*' => 'file|image|max:2048',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $resource->update($request->all());

        if ($request->hasFile('images')) {
            $images = [];
            foreach ($request->file('images') as $image) {
                $path = $image->store('resources-images', 'public');
                $images[] = $path;
            }
            $resource->images = $images;
            $resource->save();
        }

        return response()->json($resource);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $resource = Resource::find($id);
    
        if (!$resource) {
            return response()->json(['error' => 'Resource not found'], 404);
        }
    
        $resource->delete();
    
        return response()->json(['message' => 'Resource deleted successfully']);
    }
}

