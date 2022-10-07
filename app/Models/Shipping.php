<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    use HasFactory;

    protected $fillable = [
        "alamat",
        "provinsi",
        "kota",
        "kecamatan",
        "kelurahan",
        "kode_pos",
        "no_hp",
        "no_resi",
        "jasa_expedisi",
        "layanan_ekspedisi",
        "harga_layanan" ,
        "transaction_id",
        "no_rumah"
    ];
}
