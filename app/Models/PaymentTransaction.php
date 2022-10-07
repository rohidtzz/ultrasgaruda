<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_pengirim',
        'bukti_image',
        'no_rek',
        'nama_bank',
        'transaction_id'
    ];

    // public function paytrans(){
    //     return $this->hasOne(Transaction::class,'id');
    // }


}
