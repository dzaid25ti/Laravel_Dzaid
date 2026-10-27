<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Portofolio_1055;

class PortofolioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
       $portofolioList = Portofolio_1055::all();
        return view('admin.CV.index', compact('portofolioList'));
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
        $request->validate([
            'nama' => 'required',
        'tempat_tinggal' => 'required',
        'kontak' => 'required',
        'sosial_media' => 'required',
        'tentang_saya' => 'nullable',
        'keahlian' => 'required',
        'riwayat_pendidikan' => 'required',
        'pengalaman_kerja' => 'nullable',
        'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $data = $request->all();

        if ($request->hasFile('foto')) {
            $data['foto'] = $request->file('foto')->store('foto-cv', 'public');
        }

        Portofolio_1055::create($data);
        return redirect()->back()->with('success', 'Data CV berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(Request $request, string $id)
    {
        $request->validate([
            'nama' => 'required',
            'tempat_tinggal' => 'required',
            'kontak' => 'required',
            'sosial_media' => 'required',
            'keahlian' => 'required',
            'riwayat_pendidikan' => 'required',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $portofolio = Portofolio_1055::findOrFail($id);
        $data = $request->all();

        if ($request->hasFile('foto')) {
            if ($portofolio->foto) {
                \Storage::disk('public')->delete($portofolio->foto);
            }
            $data['foto'] = $request->file('foto')->store('foto-cv', 'public');
        }

        $portofolio->update($data);
        return redirect()->back()->with('success', 'Data CV berhasil diperbarui!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $portofolio = Portofolio_1055::findOrFail($id);
        if ($portofolio->foto) {
            \Storage::disk('public')->delete($portofolio->foto);
        }
        $portofolio->delete();
        return redirect()->back()->with('success', 'Data CV berhasil dihapus!');
    }
}
