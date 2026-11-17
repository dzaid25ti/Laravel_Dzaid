<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $data['users'] = User::all();
        return view('user.index', $data);
    }
    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $data['name']     = $request->name;
        $data['email']    = $request->email;
        $data['password'] = Hash::make($request->password);

        User::create($data);

        return redirect()->route('user.index')->with('success', 'Penambahan Data Berhasil!');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        $data['user'] = User::findOrFail($id);
        return view('admin.user.edit', $data);
    }

    public function update(Request $request, string $id)
    {
        $user_id = $id;
        $user    = User::findOrFail($user_id);

        $user->name  = $request->name;
        $user->email = $request->email;

        // Memperbarui password hanya jika input password diisi pada form edit
        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();
        return redirect()->route('user.index')->with('success', 'Perubahan Data Berhasil!');
    }
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('user.index')->with('success', 'Data berhasil dihapus');
    }
}