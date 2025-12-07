<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pesanan extends Model
{
    use HasFactory;
    protected $table = 'pesanan';
    protected $fillable = 
    [
        'id_users',
        'id_rekening',
        'tanggal_pesanan',
        'pesanan',
        'nama_penerima',
        'lokasi_antar',
        'total_bayar',
        'bukti_pembayaran',
        'status_pesanan',
    ];
    
    public function users(){
        return $this->belongsTo(User::class, 'id_users', 'id');
    }

}
