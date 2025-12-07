<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
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
        $data = User::where('id', '!=', 1)->where('id', "!=", Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        return view('admin.kelola_user.index', compact('data'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kelola_user.create');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'role' => 'required|string|in:Customer,Admin',
        ]);
        
        if ($request->hasFile('foto')) {
            $request->validate(['foto' => 'image|mimes:jpg,jpeg,png,gif|max:2048']);
            $file = $request->file('foto');
            $namaFile = str_replace(' ', '_', strtolower($data['username'])) . '-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/foto_users', $namaFile);
            $data['foto'] = $namaFile;
        }else{
            $data['foto'] = 'profile-blank.jpeg';
        }
        

        
        //Hash Password
        $data['password'] = Hash::make($data['password']);

        // Create the user
        $done = User::create($data);
        
        if ($done) {
            return redirect('/admin/kelola_user')->with('berhasil', 'Data berhasil ditambahkan!');
        } else {
            return redirect('/admin/kelola_user')->with('gagal', 'Data gagal ditambahkan!');
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user, $id)
    {
        $user = User::where('id', $id)->first();
        return view('admin.kelola_user.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id){
        $user = User::findOrFail($id);

        // Validasi input dasar
        $rules = [
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
            'role' => 'required|string|in:Customer,Admin',
        ];

        // Jika ada input password, tambahkan validasinya
        if ($request->filled('password')) {
            $rules['password'] = 'string|min:8';
        }

        // Jika ada file foto, tambahkan validasinya
        if ($request->hasFile('foto')) {
            $rules['foto'] = 'image|mimes:jpg,jpeg,png,gif|max:2048';
        }

        $data = $request->validate($rules);

        // Handle upload foto baru
        if ($request->hasFile('foto')) {
            if ($user->foto && Storage::exists('public/foto_users/' . $user->foto) && $user->foto != 'profile-blank.jpeg') {
                Storage::delete('public/foto_users/' . $user->foto);
            }

            $file = $request->file('foto');
            $namaFile = str_replace(' ', '_', strtolower($data['username'])) . '-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/foto_users', $namaFile);
            $data['foto'] = $namaFile;
        }

        // Handle password (jika diisi)
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']); // jangan update password
        }

        // Update user
        $done = $user->update($data);

        if ($done) {
            return redirect('/admin/kelola_user')->with('berhasil', 'Data berhasil diperbarui!');
        } else {
            return redirect('/admin/kelola_user')->with('gagal', 'Data gagal diperbarui!');
        }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user, $id)
    {
        $user = User::findOrFail($id);
        if ($user->foto && Storage::exists('public/foto_users/' . $user->foto) && $user->foto != 'profile-blank.jpeg') {
            Storage::delete('public/foto_users/' . $user->foto);
        }
        $done = $user->delete();
        
        if ($done) {
            return redirect('/admin/kelola_user')->with('berhasil', 'Data berhasil dihapus!');
        } else {
            return redirect('/admin/kelola_user')->with('gagal', 'Data gagal dihapus!');
        }
    }
}
