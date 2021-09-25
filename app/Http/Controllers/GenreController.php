<?php

namespace App\Http\Controllers;

use App\Genre;
use Illuminate\Http\Request;

class GenreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            return response()->json([
                'data' => Genre::all(),
                'message' => 'Success'
            ], 200);
        } catch(Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try{
            $genre = new Genre();
            $genre->name = $request->name;
            $genre->save();

            return response()->json($genre, 201);
        }catch (\Exception $exception){
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Genre $genre)
    {
        try {
            return response()->json($genre, 200);
        } catch (Exception $exception) {
            return  response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Genre $genre)
    {
        try {
            $genre->update($request->all());

            return response()->json([
                'data'    => $genre,
                'message' => 'Success'
            ], 201);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Genre  $genre
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Genre $genre)
    {
        try{
            $genre->delete();
            return response()->json(['message' => 'Deleted'],205);
        }catch(Exception $exception){
            return response()->json(['error' => $exception], 500);
        }
    }
}

