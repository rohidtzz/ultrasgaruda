<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class Transaction extends Model
{
    use HasFactory;
    use AutoNumberTrait;

    protected $fillable = [
        'no_invoice',
        'qty',
        'size',
        'total',
        'user_id',
        'data',
        'status',
    ];

    public function paytrans(){
        return $this->hasOne(PaymentTransaction::class,'transaction_id');
    }

    public function shipping(){
        return $this->hasOne(shipping::class,'transaction_id');
    }


    public function getAutoNumberOptions()
    {
        return [
            'no_invoice' => [
                'format' => function () {
                    return date('dmy') . '/TGR/INV/?';
                },
                'length' => 5
            ]
        ];
    }
}
