<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    /**
     * GET /api/students
     * Mengambil seluruh data mahasiswa.
     */
    public function index(): JsonResponse
    {
        $students = Student::orderBy('created_at', 'desc')->get();

        return response()->json([
            'success' => true,
            'message' => 'Data mahasiswa berhasil diambil',
            'data'    => $students,
        ]);
    }

    /**
     * POST /api/students
     * Menyimpan data mahasiswa baru.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'nim'    => 'required|string|max:20|unique:students,nim',
            'nama'   => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'email'  => 'required|email|max:255|unique:students,email',
            'no_hp'  => 'nullable|string|max:15',
        ]);

        $student = Student::create($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data mahasiswa berhasil ditambahkan',
            'data'    => $student,
        ], 201);
    }

    /**
     * GET /api/students/{id}
     * Mengambil data satu mahasiswa berdasarkan ID.
     */
    public function show(string $id): JsonResponse
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Data mahasiswa tidak ditemukan',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'message' => 'Detail mahasiswa berhasil diambil',
            'data'    => $student,
        ]);
    }

    /**
     * PUT /api/students/{id}
     * Mengubah data mahasiswa berdasarkan ID.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Data mahasiswa tidak ditemukan',
            ], 404);
        }

        $validated = $request->validate([
            'nim'    => ['required', 'string', 'max:20', Rule::unique('students', 'nim')->ignore($student->id)],
            'nama'   => 'required|string|max:255',
            'jurusan' => 'required|string|max:255',
            'email'  => ['required', 'email', 'max:255', Rule::unique('students', 'email')->ignore($student->id)],
            'no_hp'  => 'nullable|string|max:15',
        ]);

        $student->update($validated);

        return response()->json([
            'success' => true,
            'message' => 'Data mahasiswa berhasil diperbarui',
            'data'    => $student,
        ]);
    }

    /**
     * DELETE /api/students/{id}
     * Menghapus data mahasiswa berdasarkan ID.
     */
    public function destroy(string $id): JsonResponse
    {
        $student = Student::find($id);

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Data mahasiswa tidak ditemukan',
            ], 404);
        }

        $student->delete();

        return response()->json([
            'success' => true,
            'message' => 'Data mahasiswa berhasil dihapus',
        ]);
    }
}
