<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Rekening;
use Illuminate\Http\Request;

class RekeningController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Rekening::orderBy('created_at', 'DESC')->get();
        return view('admin.kelola_rekening.index', compact('data'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kelola_rekening.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_rekening' => 'required|string|max:255',
            'nomor_rekening' => 'required|string',
            'nama_bank' => 'required|string|max:255',
        ]);
        
        $done = Rekening::create($data);
        
        if ($done) {
            return redirect('/admin/kelola_rekening')->with('berhasil', 'Data berhasil ditambahkan!');
        } else {
            return redirect('/admin/kelola_rekening')->with('gagal', 'Data gagal ditambahkan!');
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(Rekening $rekening)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rekening $rekening, $id)
    {
        $rekening = Rekening::where('id', $id)->first();
        return view('admin.kelola_rekening.edit', compact('rekening'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, Rekening $rekening)
    {
        $data = $request->validate([
            'nama_rekening' => 'required|string|max:255',
            'nomor_rekening' => 'required|string',
            'nama_bank' => 'required|string|max:255',
        ]);
        
        $done = Rekening::find($id)->update($data);
        
        if ($done) {
            return redirect('/admin/kelola_rekening')->with('berhasil', 'Data berhasil diubah!');
        } else {
            return redirect('/admin/kelola_rekening')->with('gagal', 'Data gagal diubah!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Rekening $rekening, $id)
    {
        $done = Rekening::find($id)->delete();
        
        if ($done) {
            return redirect('/admin/kelola_rekening')->with('berhasil', 'Data berhasil dihapus!');
        } else {
            return redirect('/admin/kelola_rekening')->with('gagal', 'Data gagal dihapus!');
        }
    }
}
