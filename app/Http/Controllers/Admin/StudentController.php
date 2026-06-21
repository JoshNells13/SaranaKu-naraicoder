<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class StudentController extends Controller
{
    public function index()
    {
        $query = User::where('role', 'murid');

        if (request('search')) {
            $query->where(function ($q) {
                $q->where('name', 'like', '%' . request('search') . '%')
                  ->orWhere('email', 'like', '%' . request('search') . '%');
            });
        }

        if (request('kelas') && request('kelas') !== 'all') {
            $query->where('kelas', request('kelas'));
        }

        if (request('jurusan') && request('jurusan') !== 'all') {
            $query->where('jurusan', request('jurusan'));
        }

        $students = $query->latest()->paginate(15)->withQueryString();

        // Extract distinct classes and majors for filter dropdowns
        $classes = User::where('role', 'murid')->whereNotNull('kelas')->distinct()->pluck('kelas')->filter()->values();
        $majors = User::where('role', 'murid')->whereNotNull('jurusan')->distinct()->pluck('jurusan')->filter()->values();

        return view('admin.students.index', compact('students', 'classes', 'majors'));
    }

    public function create()
    {
        return view('admin.students.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'kelas' => ['required', 'string', 'max:50'],
            'jurusan' => ['required', 'string', 'max:100'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'kelas.required' => 'Kelas wajib diisi.',
            'jurusan.required' => 'Jurusan wajib diisi.',
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'murid',
            'kelas' => $validated['kelas'],
            'jurusan' => $validated['jurusan'],
        ]);

        return redirect()->route('admin.students.index')
            ->with('success', 'Akun murid berhasil ditambahkan!');
    }

    public function edit(User $student)
    {
        if ($student->role !== 'murid') {
            abort(404);
        }

        return view('admin.students.edit', compact('student'));
    }

    public function update(Request $request, User $student)
    {
        if ($student->role !== 'murid') {
            abort(404);
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', Rule::unique('users')->ignore($student->id)],
            'password' => ['nullable', 'min:8', 'confirmed'],
            'kelas' => ['required', 'string', 'max:50'],
            'jurusan' => ['required', 'string', 'max:100'],
        ], [
            'name.required' => 'Nama lengkap wajib diisi.',
            'email.required' => 'Email wajib diisi.',
            'email.unique' => 'Email sudah terdaftar.',
            'password.min' => 'Password minimal 8 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
            'kelas.required' => 'Kelas wajib diisi.',
            'jurusan.required' => 'Jurusan wajib diisi.',
        ]);

        $data = [
            'name' => $validated['name'],
            'email' => $validated['email'],
            'kelas' => $validated['kelas'],
            'jurusan' => $validated['jurusan'],
        ];

        if (!empty($validated['password'])) {
            $data['password'] = Hash::make($validated['password']);
        }

        $student->update($data);

        return redirect()->route('admin.students.index')
            ->with('success', 'Akun murid berhasil diperbarui!');
    }

    public function destroy(User $student)
    {
        if ($student->role !== 'murid') {
            abort(404);
        }

        $student->delete();

        return redirect()->route('admin.students.index')
            ->with('success', 'Akun murid berhasil dihapus!');
    }
}
