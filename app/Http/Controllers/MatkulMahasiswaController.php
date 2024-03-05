<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MatkulMahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
            'matkul_id' => 'required|integer|exists:matkul,id',
            'mahasiswa_id' => 'required|integer|exists:mahasiswa,id',
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

        $mahasiswa = Mahasiswa::find($request->json('mahasiswa_id'));
        $mahasiswa->matkul()->attach($request->json('matkul_id'));

        return response()->json([
            'success' => true,
            'code' => 201,
            'message' => 'Matkul added successfully'
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mahasiswa $mahasiswa)
    {
        $matkul = $mahasiswa->matkul;
        return response()->json([
            'success' => true,
            'code' => 200,
            'data' => $matkul
        ], 200);
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
    public function update(Request $request)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        $validate = Validator::make($request->json()->all(), [
            'matkul_id' => 'required|integer|exists:matkul,id',
            'mahasiswa_id' => 'required|integer|exists:mahasiswa,id',
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

        $mahasiswa = Mahasiswa::find($request->json('mahasiswa_id'));
        $mahasiswa->matkul()->detach($request->json('matkul_id'));

        return response()->json([
            'success' => true,
            'code' => 200,
            'message' => 'Matkul remove successfully'
        ], 200);
    }
}
