<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Mahasiswa retrieved successfully',
            'data' =>  Mahasiswa::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = Validator::make($request->json()->all(), [
            'nim' => 'required|min:8|max:8|string|unique:mahasiswa,nim',
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
        $mahasiswa = Mahasiswa::create([
            'nama' => $request->json('nama'),
            'nim' => $request->json('nim')
        ]);

        return response()->json([
            'success' => true,
            'code' => 201,
            'message' => 'Mahasiswa created successfully',
            'data' =>  $mahasiswa
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Mahasiswa retrieved successfully',
            'data' =>  $mahasiswa
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Mahasiswa $mahasiswa)
    {
        $validate = Validator::make($request->json()->all(), [
            'nim' => 'required|min:8|max:8|string|unique:mahasiswa,nim,' . $mahasiswa->id,
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
        $mahasiswa->update([
            'nama' => $request->json('nama'),
            'nim' => $request->json('nim')
        ]);

        return response()->json([
            'success' => true,
            'code' => 201,
            'message' => 'Mahasiswa created successfully',
            'data' =>  $mahasiswa
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mahasiswa $mahasiswa)
    {
        if ($mahasiswa->matkul()->detach()) {
            return response()->json([
                'success' => false,
                'code' => 400,
                'message' => 'Cannot delete mahasiswa because it has a relationship with matkul'
            ], 400);
        }
        $mahasiswa->delete();
        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Mahasiswa deleted successfully'
        ]);
    }
}
