<?php

namespace App\Http\Controllers;

use App\Models\Matkul;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatkulController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Matkul retrieved successfully',
            'data' =>  Matkul::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->json()->all(), [
            'sks' => 'required|integer',
            'nama' => 'required|min:3|max:128|string',
        ]);

        if ($validate->fails()) {
            $errors = $validate->errors();
            $errorMessage = [];

            foreach ($errors->all() as $message) {
                $errorMessage[] = $message;
            }

            return response()->json([
                'success' => false,
                'code' => 422,
                'message' => 'Unprocessable Entity',
                'errors' => $errorMessage
            ], 422);
        }


        // create the mahasiswa
        $matkul = Matkul::create([
            'nama' => $request->json('nama'),
            'sks' => $request->json('sks')
        ]);

        return response()->json([
            'success' => true,
            'code' => 201,
            'message' => 'Matkul created successfully',
            'data' =>  $matkul
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Matkul $matkul)
    {
        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Matkul retrieved successfully',
            'data' =>  $matkul
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Matkul $matkul)
    {
        $validate = Validator::make($request->json()->all(), [
            'sks' => 'required|integer',
            'nama' => 'required|min:3|max:128|string',
        ]);

        if ($validate->fails()) {
            $errors = $validate->errors();
            $errorMessage = [];

            foreach ($errors->all() as $message) {
                $errorMessage[] = $message;
            }

            return response()->json([
                'success' => false,
                'code' => 422,
                'message' => 'Unprocessable Entity',
                'errors' => $errorMessage
            ], 422);
        }


        // create the mahasiswa
        $matkul->update([
            'nama' => $request->json('nama'),
            'sks' => $request->json('sks')
        ]);

        return response()->json([
            'success' => true,
            'code' => 201,
            'message' => 'Matkul created successfully',
            'data' =>  $matkul
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Matkul $matkul)
    {
        if ($matkul->mahasiswa()->detach()) {
            return response()->json([
                'success' => false,
                'code' => 400,
                'message' => 'Cannot delete matkul because it has a relationship with matkul'
            ], 400);
        }
        $matkul->delete();
        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Matkul deleted successfully',
        ], 200);
    }
}
