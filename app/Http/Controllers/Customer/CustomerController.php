<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\Rekening;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class CustomerController extends Controller
{
    public function index(){
        $menu = Menu::orderBy('created_at', 'DESC')->get();
        return view('customer.dashboard', compact('menu'));
    }

    public function menu(){
        $menu = Menu::orderBy('created_at', 'DESC')->get();
        return view('customer.menu', compact('menu'));
    }
    public function riwayat(){
        $pesanan = Pesanan::where('id_users', Auth::user()->id)->orderBy('created_at', 'DESC')->get();
        return view('customer.riwayat', compact('pesanan'));
    }
    public function riwayatDetail($id){
        $pesanan = Pesanan::where('id', $id)->first();
        return view('customer.riwayatDetail', compact('pesanan'));
    }
    public function riwayatHapus($id){
        $pesanan = Pesanan::findOrFail($id);
        if ($pesanan->bukti_pembayaran && Storage::exists('public/bukti_pembayaran/' . $pesanan->bukti_pembayaran)) {
            Storage::delete('public/bukti_pembayaran/' . $pesanan->bukti_pembayaran);
        }
        foreach(json_decode($pesanan->pesanan) as $item){
            $menu = Menu::findOrFail($item->id);
            $update_stok = $menu->stok_menu + $item->jumlah_menu;
            $menu->update(['stok_menu'  => $update_stok ]);
        }

        $done = $pesanan->delete();
        
        if ($done) {
            return redirect('/customer/riwayat')->with('berhasil', 'Data berhasil dihapus!');
        } else {
            return redirect('/customer/riwayat')->with('gagal', 'Data gagal dihapus!');
        }
        $pesanan = Pesanan::where('id', $id)->first();
        return view('customer.riwayatDetail', compact('pesanan'));
    }

    public function keranjang(){
        return view('customer.keranjang');
    }

    public function pembayaran(){
        $rekening = Rekening::orderBy('created_at','DESC')->get();
        return view('customer.pembayaran', compact('rekening'));
    }
    public function pembayaranProses(Request $request){
        $data = $request->validate([
            'id_rekening' => 'required|exists:rekening,id',
            'nama_penerima' => 'required|string|max:255',
            'lokasi_antar' => 'required|string|max:255',
            'total_bayar' => 'required|string',
            'bukti_pembayaran' => 'required|image|mimes:jpg,jpeg,png|max:2048', // max 2MB
        ]);
        $data['total_bayar'] = preg_replace('/[^0-9]/', '', $data['total_bayar']);
        $data['pesanan'] = json_encode(json_decode($request->pesanan, true));
        $data['id_users'] = Auth::user()->id;
        $data['tanggal_pesanan'] = date('Y-m-d H:i:s');
        $data['status_pesanan'] = 'diproses';
        foreach(json_decode($data['pesanan']) as $key => $item){
            $menu = Menu::findOrFail($item->id);
            $update_stok = $menu->stok_menu - $item->jumlah_menu;
            if($update_stok > 0){
                $menu->update(['stok_menu'  => $update_stok ]);
            }else{
                return redirect('/customer/keranjang')->with('gagal', 'Data gagal ditambahkan! Stok'. $menu->nama_menu . ' tidak cukup!' );
            }
        }
        $nama = User::where('id', $data['id_users'])->first()->username;
        if ($request->hasFile('bukti_pembayaran')) {
            $file = $request->file('bukti_pembayaran');
            $namaFile = str_replace(' ', '_', strtolower($nama)) . '-' . date('YmdHis') . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('public/bukti_pembayaran', $namaFile);
            $data['bukti_pembayaran'] = $namaFile;
        }

        $done = Pesanan::create($data);
        
        if ($done) {
            return redirect('/customer/riwayat')->with('berhasil', 'Pembayaran berhasil dilakukan!');
        } else {
            return redirect('/customer/pembayaran')->with('gagal', 'Pembayaran gagal dilakukan!');
        }
    }
    
    public function profile(){
        $data = User::where('id', Auth::user()->id)->first();
        return view('customer.profil', compact('data'));
    }

    public function profileChange(Request $request, $id){
        $user = User::findOrFail($id);

        // Validasi input dasar
        $rules = [
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'no_hp' => 'required|string|max:15',
            'alamat' => 'required|string|max:255',
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
            return redirect()->back()->with('berhasil', 'Data berhasil diperbarui!');
        } else {
            return redirect()->back()->with('gagal', 'Data gagal diperbarui!');
        }
    }

}