<?php

namespace App\Http\Controllers;

use App\Platform;
use Illuminate\Http\Request;

class PlatformController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return response()->json([
                'data'    => Platform::with('games')->get(),
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $platform = new Platform();
        $platform->name = $request->name;
        $platform->save();

        $platform->games()->sync($request->games);

        return response()->json($platform->load('games'), 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Platform  $platform
     * @return \Illuminate\Http\Response
     */
    public function show(Platform $platform)
    {
        try {
            return response()->json($platform->load('games'), 200);
        } catch (Exception $exception) {
            return  response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Platform  $platform
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Platform $platform)
    {
        try {
            $platform->update($request->all());

            $platform->games()->sync($request->input('games'));

            return response()->json([
                'data'    => $platform,
                'message' => 'Success'
            ], 201);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Platform  $platform
     * @return \Illuminate\Http\Response
     */
    public function destroy(Platform $platform)
    {
        try{
            $platform->delete();
            return response()->json(['message' => 'Deleted'],205);

        }catch(Exception $exception){

            return response()->json(['error' => $exception], 500);
        }
    }
}
