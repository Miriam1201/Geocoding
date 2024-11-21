<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\Api\ResourceController;
use App\Http\Controllers\Api\CityController;

Route::get('/user', function (Request $request): JsonResponse {
    try {
        $user = $request->user();
        return response()->json($user); 
        //return $request->user();
    } catch (Throwable $e){
        return response()->json([
            'error'=> $e->getMessage(),
        ]);
    }
})->middleware('auth:sanctum');

Route::post('/tokens/create', function (Request $request) {
    try {
        // Validar las credenciales de entrada
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
            'token_name' => 'required|string|max:255',
        ]);

        // Buscar el usuario por correo
        $user = \App\Models\User::where('email', $request->email)->first();

        // Verificar que el usuario existe y las credenciales coinciden
        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['error' => 'Credenciales inválidas'], 401);
        }

        // Crear un token para el usuario
        $token = $user->createToken($request->token_name);

        // Devolver el token en texto plano
        return response()->json(['token' => $token->plainTextToken]);
    } catch (\Throwable $e) {
        return response()->json(['error' => $e->getMessage()], 500);
    }
});


Route::middleware(['auth:sanctum'])->group(function () {

    // Categorías
    Route::get('categories', [CategoryController::class, 'index']); // Obtener todas las categorías
    Route::get('categories/{category}', [CategoryController::class, 'show']); // Obtener una categoría específica
    Route::post('categories', [CategoryController::class, 'store']); // Crear nueva categoría
    Route::put('categories/{category}', [CategoryController::class, 'update']); // Editar categoría
    Route::delete('categories/{category}', [CategoryController::class, 'destroy']); // Eliminar categoría

    // Subcategorías
    Route::get('/subcategories', [SubCategoryController::class, 'index']);
    Route::get('/subcategories/{id}', [SubCategoryController::class, 'show']);
    Route::post('/subcategories', [SubCategoryController::class, 'store']);
    Route::put('/subcategories/{id}', [SubCategoryController::class, 'update']);
    Route::delete('/subcategories/{id}', [SubCategoryController::class, 'destroy']);

    // Recursos
    Route::get('resources', [ResourceController::class, 'index']);
    Route::post('resources', [ResourceController::class, 'store']);
    Route::get('resources/{resource}', [ResourceController::class, 'show']);
    Route::put('resources/{resource}', [ResourceController::class, 'update']);
    Route::delete('resources/{resource}', [ResourceController::class, 'destroy']);

    // Ciudades
    Route::get('cities', [CityController::class, 'index']);
    Route::post('cities', [CityController::class, 'store']);
    Route::get('cities/{city}', [CityController::class, 'show']);
    Route::put('cities/{city}', [CityController::class, 'update']);
    Route::delete('cities/{city}', [CityController::class, 'destroy']);
    
});
