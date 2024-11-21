<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\SubCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SubCategoryController extends Controller
{
    // Obtener todas las subcategorías
    public function index()
    {
        $subcategories = SubCategory::with('category')->get();
        return response()->json($subcategories);
    }

    // Obtener una subcategoría específica
    public function show($id)
    {
        $subcategory = SubCategory::with('category')->find($id);

        if (!$subcategory) {
            return response()->json(['error' => 'SubCategory not found'], 404);
        }

        return response()->json($subcategory);
    }

    // Crear una nueva subcategoría
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'order' => 'nullable|integer',
            'category_id' => 'required|exists:categories,id',
            'color' => 'nullable|string',
            'background' => 'nullable|image',
            'icon' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Subir archivos si están presentes
        $backgroundPath = $request->file('background') ? $request->file('background')->store('subcategory-images-backgrounds', 'public') : null;
        $iconPath = $request->file('icon') ? $request->file('icon')->store('subcategory-images-icons', 'public') : null;

        $subcategory = SubCategory::create([
            'name' => $request->name,
            'order' => $request->order,
            'category_id' => $request->category_id,
            'color' => $request->color,
            'background' => $backgroundPath,
            'icon' => $iconPath,
        ]);

        return response()->json($subcategory, 201);
    }

    // Actualizar una subcategoría existente
    public function update(Request $request, $id)
    {
        $subcategory = SubCategory::find($id);

        if (!$subcategory) {
            return response()->json(['error' => 'SubCategory not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'order' => 'nullable|integer',
            'category_id' => 'required|exists:categories,id',
            'color' => 'nullable|string',
            'background' => 'nullable|image',
            'icon' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Actualizar archivos si están presentes
        if ($request->hasFile('background')) {
            $subcategory->background = $request->file('background')->store('subcategory-images-backgrounds', 'public');
        }
        if ($request->hasFile('icon')) {
            $subcategory->icon = $request->file('icon')->store('subcategory-images-icons', 'public');
        }

        $subcategory->update([
            'name' => $request->name,
            'order' => $request->order,
            'category_id' => $request->category_id,
            'color' => $request->color,
        ]);

        return response()->json($subcategory);
    }

    // Eliminar una subcategoría
    public function destroy($id)
    {
        $subcategory = SubCategory::find($id);

        if (!$subcategory) {
            return response()->json(['error' => 'SubCategory not found'], 404);
        }

        $subcategory->delete();

        return response()->json(['message' => 'SubCategory deleted successfully']);
    }
}
