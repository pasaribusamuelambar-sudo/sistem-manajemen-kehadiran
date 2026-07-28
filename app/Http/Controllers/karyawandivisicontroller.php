<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class KaryawandivisiController extends Controller
{
    // Memproses Tambah Karyawan Baru (Create)
    public function store(Request $request)
    {
        $request->validate([
            'id_kerja' => 'required|string|max:50|unique:users,id_kerja',
            'name'     => 'required|string|max:255',
            'role'     => 'required|string',
            'password' => 'required|string|min:8',
            'no_hp'    => 'required|string|max:20',
            'email'    => 'required|email|max:255|unique:users,email',
            'divisi'   => 'required|string',
            'status'   => 'required|in:Aktif,Cuti,Non-Aktif',
        ]);

        User::create([
            'id_kerja'      => $request->id_kerja,
            'name'          => $request->name,
            'role'          => $request->role,
            'password'      => Hash::make($request->password),
            'real_password' => $request->password,
            'no_hp'         => $request->no_hp,
            'email'         => $request->email,
            'divisi'        => $request->divisi,
            'status'        => $request->status,
        ]);

        return redirect()->back()->with('success', 'Data personel baru berhasil ditambahkan!');
    }

    // Memproses Perubahan Data Karyawan (Update)
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'id_kerja' => ['required', 'string', 'max:50', Rule::unique('users')->ignore($user->id)],
            'name'     => 'required|string|max:255',
            'role'     => 'required|string',
            'no_hp'    => 'required|string|max:20',
            'email'    => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'divisi'   => 'required|string',
            'status'   => 'required|in:Aktif,Cuti,Non-Aktif',
            'password' => 'nullable|string|min:8',
        ]);

        $updateData = [
            'id_kerja' => $request->id_kerja,
            'name'     => $request->name,
            'role'     => $request->role,
            'no_hp'    => $request->no_hp,
            'email'    => $request->email,
            'divisi'   => $request->divisi,
            'status'   => $request->status,
        ];

        if ($request->filled('password')) {
            $updateData['password']      = Hash::make($request->password);
            $updateData['real_password'] = $request->password;
        }

        $user->update($updateData);

        return redirect()->back()->with('success', 'Data karyawan ' . $user->name . ' berhasil diperbarui.');
    }

    // Memproses Hapus Karyawan (Delete)
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $nama = $user->name;
        
        $user->delete();

        return redirect()->back()->with('success', 'Data karyawan ' . $nama . ' telah berhasil dihapus.');
    }
}