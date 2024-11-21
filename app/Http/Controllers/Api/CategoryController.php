<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    // Obtener todas las categorías
    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }

    // Mostrar una categoría específica
    public function show(Category $category)
    {
        return response()->json($category);
    }

    // Crear una nueva categoría
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'order' => 'required|integer',
            'color' => 'nullable|string',
            'background' => 'nullable|image',
            'icon' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Crear la categoría
        $category = Category::create([
            'name' => $request->name,
            'order' => $request->order,
            'color' => $request->color,
            'background' => $request->background,
            'icon' => $request->icon,
        ]);

        return response()->json($category, 201);
    }

    // Editar una categoría
    public function update(Request $request, Category $category)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'order' => 'required|integer',
            'color' => 'nullable|string',
            'background' => 'nullable|image',
            'icon' => 'nullable|image',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Actualizar categoría
        $category->update([
            'name' => $request->name,
            'order' => $request->order,
            'color' => $request->color,
            'background' => $request->background,
            'icon' => $request->icon,
        ]);

        return response()->json($category);
    }

    // Eliminar una categoría
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(['message' => 'Category deleted successfully.']);
    }
}
