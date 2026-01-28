<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Muestra la lista de posts (GET)
     */
    public function index()
    {
        // Devuelve todos los posts
        return Post::all();
    }

    /**
     * Show the form for creating a new resource.
     * (Solo se usa si haces una web con vistas Blade, ignorar para API)
     */
    public function create()
    {
        //
    }

    /**
     * Guarda el nuevo post en la base de datos (POST)
     */
    public function store(Request $request)
    {
        // 1. Validamos que lleguen los datos correctos
        $validatedData = $request->validate([
            'title'   => 'required|string|max:255',
            'content' => 'required|string',
            'user_id' => 'required|integer|exists:users,id', 
        ]);

        // 2. Creamos el post usando el Modelo
        // Como definiste $fillable en el modelo, esto es seguro.
        $post = Post::create($validatedData);

        // 3. IMPORTANTE: Devolvemos el post creado y código 201 (Created)
        return response()->json([
            'message' => 'Post creado con éxito',
            'data' => $post
        ], 201);
    }

    /**
     * Muestra un post específico por su ID (GET)
     */
    public function show(Post $post)
    {
        // Laravel busca automáticamente el ID gracias al "Route Model Binding"
        return $post;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Actualiza un post existente (PUT/PATCH)
     */
    public function update(Request $request, Post $post)
    {
        $validatedData = $request->validate([
            'title'   => 'sometimes|string|max:255',
            'content' => 'sometimes|string',
        ]);

        $post->update($validatedData);

        return response()->json($post, 200);
    }

    /**
     * Elimina un post (DELETE)
     */
    public function destroy(Post $post)
    {
        $post->delete();

        return response()->json(['message' => 'Post eliminado'], 204);
    }
}