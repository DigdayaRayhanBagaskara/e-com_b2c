<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use App\Models\Pesanan;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PesananController extends Controller
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
        $data = Pesanan::orderBy('created_at', 'ASC')->where('status_pesanan', 'diproses')->get();
        $selesai = Pesanan::orderBy('created_at', 'DESC')->where('status_pesanan', '!=', 'diproses')->get();
        return view('admin.kelola_pesanan.index', compact('data', 'selesai'));
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.kelola_pesanan.create');
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }
    
    /**
     * Display the specified resource.
     */
    public function show(Pesanan $pesanan, $id)
    {
        $pesanan = Pesanan::where('id', $id)->first();
        return view('admin.kelola_pesanan.detail', compact('pesanan'));
    }

    public function proses(Request $request, $id){
        $data = $request->all();
        $pesanan = Pesanan::findOrFail($id);
    
        $status_sebelumnya = $pesanan->status_pesanan;
        $status_baru = $data['status_pesanan'];
    
        if ($status_sebelumnya === $status_baru) {
            return redirect()->back()->with('gagal', 'Status tidak berubah.');
        }
    
        // diproses/diterima -> ditolak = tambah stok
        if (in_array($status_sebelumnya, ['diproses', 'diterima']) && $status_baru === 'ditolak') {
            foreach(json_decode($pesanan->pesanan) as $item){
                $menu = Menu::findOrFail($item->id);
                $menu->update(['stok_menu' => $menu->stok_menu + $item->jumlah_menu]);
            }
        }
    
        // ditolak -> diproses atau diterima = kurangi stok
        if ($status_sebelumnya === 'ditolak' && in_array($status_baru, ['diproses', 'diterima'])) {
            foreach(json_decode($pesanan->pesanan) as $item){
                $menu = Menu::findOrFail($item->id);
                if($menu->stok_menu < $item->jumlah_menu){
                    return redirect()->back()->with('gagal', "Stok menu {$menu->nama_menu} tidak cukup!");
                }
                $menu->update(['stok_menu' => $menu->stok_menu - $item->jumlah_menu]);
            }
        }
    
        $done = $pesanan->update($data);
    
        if($done){
            return redirect()->back()->with('berhasil', 'Status Pesanan berhasil diperbarui');
        }else{
            return redirect()->back()->with('gagal', 'Status Pesanan gagal diperbarui');
        }
    }
    
    
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pesanan $pesanan)
    {
        return view('admin.kelola_pesanan.edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pesanan $pesanan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pesanan $pesanan, $id)
    {
        $pesanan = Pesanan::findOrFail($id);
        if ($pesanan->bukti_pembayaran && Storage::exists('public/bukti_pembayaran/' . $pesanan->bukti_pembayaran)) {
            Storage::delete('public/bukti_pembayaran/' . $pesanan->bukti_pembayaran);
        }
        if($pesanan->status_pesanan != 'ditolak'){
            foreach(json_decode($pesanan->pesanan) as $item){
                $menu = Menu::findOrFail($item->id);
                $menu->update(['stok_menu' => $menu->stok_menu + $item->jumlah_menu]);
            }
        }

        $done = $pesanan->delete();
        
        if ($done) {
            return redirect('/admin/kelola_pesanan')->with('berhasil', 'Data berhasil dihapus!');
        } else {
            return redirect('/admin/kelola_pesanan')->with('gagal', 'Data gagal dihapus!');
        }
    }

    public function laporanTransaksi(){
        $data = Pesanan::where('status_pesanan','diterima')->orderBy('created_at','DESC')->get();
        return view('admin.laporan_transaksi', compact('data'));
    }

    public function laporanTransaksiCetak(Request $request){
        $data = $request->all();
        if($data['tanggal_mulai'] == null || $data['tanggal_selesai'] == null){
            $transaksi = Pesanan::where('status_pesanan', 'diterima')->orderBy('created_at', 'DESC')->get();
        }else{
            $tm = Carbon::parse($data['tanggal_mulai'])->format('Y-m-d\TH:i:s.u\Z');
            $ts = Carbon::parse($data['tanggal_selesai'])->addDay()->format('Y-m-d\TH:i:s.u\Z');
            $transaksi = Pesanan::whereBetween('created_at', [$tm, $ts])->where('status_pesanan', 'diterima')->orderBy('created_at', 'DESC')->get();
        }      
        // return $transaksi;die;
        $pimpinan = 'Pimpinan';
        $date = date('d-M-Y H:i:s');
        return Pdf::loadView('admin.laporan_transaksiCetak', compact('transaksi', 'date', 'pimpinan'))->setPaper('A4', 'portrait')->stream('laporan_transaksi - '. $date .'.pdf');
    }


    public function profileCustomer($id){
        $user = User::where('id', $id)->first();
        return view('admin.kelola_pesanan.profile', compact('user'));
    }
}
