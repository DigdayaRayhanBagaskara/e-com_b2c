<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MenuController extends Controller
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
        $data = Menu::orderBy('created_at', 'DESC')->get();
        return view('admin.kelola_menu.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kelola_menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nama_menu' => 'required|string|max:255',
            'harga_menu' => 'required|numeric|min:0',
            'jenis_menu' => 'required|string|in:Makanan,Minuman',
            'deskripsi_menu' => 'required|string|max:1000',
            'foto_menu' => 'required|image|mimes:jpg,jpeg,png|max:2048', // max 2MB
            'stok_menu' => 'required|integer|min:0',
        ]);

        if ($request->hasFile('foto_menu')) {
            $file = $request->file('foto_menu');
            $namaFile = str_replace(' ', '_', strtolower($data['nama_menu'])) . '-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/foto_menu', $namaFile);
            $data['foto_menu'] = $namaFile;
        }

        $done = Menu::create($data);
        
        if ($done) {
            return redirect('/admin/kelola_menu')->with('berhasil', 'Data berhasil ditambahkan!');
        } else {
            return redirect('/admin/kelola_menu')->with('gagal', 'Data gagal ditambahkan!');
        }
        
    }

    /**
     * Display the specified resource.
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Menu $menu, $id)
    {
        $menu = Menu::where('id', $id)->first();
        return view('admin.kelola_menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id, Menu $menu)
    {
        $data = $request->validate([
            'nama_menu' => 'required|string|max:255',
            'harga_menu' => 'required|numeric|min:0',
            'jenis_menu' => 'required|string|in:Makanan,Minuman',
            'deskripsi_menu' => 'required|string|max:1000',
            'stok_menu' => 'required|integer|min:0',
        ]);
        
        $menu = Menu::findOrFail($id);
        
        // jika ada foto diupload
        if ($request->hasFile('foto_menu')) {
        
            // hapus foto lama
            if ($menu->foto_menu && Storage::exists('public/foto_menu/' . $menu->foto_menu)) {
                Storage::delete('public/foto_menu/' . $menu->foto_menu);
            }
        
            // simpan foto baru
            $file = $request->file('foto_menu');
            $namaFile = str_replace(' ', '_', strtolower($request->nama_menu)) . '-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/foto_menu', $namaFile);
            $data['foto_menu'] = $namaFile;
        }
        
        $done = $menu->update($data);
        
        if ($done) {
            return redirect('/admin/kelola_menu')->with('berhasil', 'Data berhasil diperbarui!');
        } else {
            return redirect('/admin/kelola_menu')->with('gagal', 'Data gagal diperbarui!');
        }        
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Menu $menu, $id)
    {
        $menu = Menu::findOrFail($id);
        if ($menu->foto_menu && Storage::exists('public/foto_menu/' . $menu->foto_menu)) {
            Storage::delete('public/foto_menu/' . $menu->foto_menu);
        }
        $done = $menu->delete();
        
        if ($done) {
            return redirect('/admin/kelola_menu')->with('berhasil', 'Data berhasil dihapus!');
        } else {
            return redirect('/admin/kelola_menu')->with('gagal', 'Data gagal dihapus!');
        }
    }
}
