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
        'status'
    ];


    public function getAutoNumberOptions()
    {
        return [
            'no_invoice' => [
                'format' => function () {
                    return date('d-m-y') . '/TGR/INV/?';
                },
                'length' => 5
            ]
        ];
    }


    public function product(){
        return $this->hasMany(Product::class,'id');
    }




}
