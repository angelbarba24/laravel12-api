<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;

class CarController extends Controller
{
    /**
     * Muestra la lista de coches (GET)
     */
    public function index()
    {
        // Devuelve todos los coches
        return Car::all();
    }


    public function create()
    {
        //
    }

    /**
     * Guarda el nuevo coche en la base de datos (POST)
     */
    public function store(Request $request)
    {
        // 1. Validamos que lleguen los datos
        $validatedData = $request->validate([
            'brand'        => 'required|string|max:255',
            'model'        => 'required|string|max:255',
            'description'  => 'required|string',
            'year'         => 'required|integer',
            'is_available' => 'boolean', // Opcional, si no se envía usa el default
        ]);

        // 2. Creamos el coche usando el Modelo y la relación con el usuario
        // Usamos $request->user() para que coja el ID del token automáticamente
        $car = $request->user()->cars()->create($validatedData);

        // 3. Devolvemos el coche creado y código 201 (Created)
        return response()->json([
            'message' => 'Coche creado con éxito',
            'data' => $car
        ], 201);
    }

    /**
     * Muestra un coche específico por su ID (GET)
     */
    public function show(Car $car)
    {
        return $car;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Car $car)
    {
        //
    }

    /**
     * Actualiza un coche existente (PUT/PATCH)
     */
    public function update(Request $request, Car $car)
    {
        // Validación de seguridad: Solo el dueño puede editar
        if ($request->user()->id !== $car->user_id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $validatedData = $request->validate([
            'brand'        => 'sometimes|string|max:255',
            'model'        => 'sometimes|string|max:255',
            'description'  => 'sometimes|string',
            'year'         => 'sometimes|integer',
            'is_available' => 'boolean',
        ]);

        $car->update($validatedData);

        return response()->json($car, 200);
    }

    /**
     * Elimina un coche (DELETE)
     */
    public function destroy(Request $request, Car $car)
    {
        // Validación de seguridad: Solo el dueño puede borrar
        if ($request->user()->id !== $car->user_id) {
            return response()->json(['message' => 'No autorizado'], 403);
        }

        $car->delete();

        return response()->json(['message' => 'Coche eliminado'], 204);
    }
}