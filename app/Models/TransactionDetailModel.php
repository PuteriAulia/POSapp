<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionDetailModel extends Model
{
    use HasFactory;
    protected $table = 'transaction_detail';
    protected $fillable = [
        'detail_qty',
        'detail_price',
        'detail_subtotal',
        'transaction_id',
        'product_id',
    ];

    public function transaction(){
        return $this->belongsTo(TransactionModel::class,'transaction_id','transaction_id');
    }

    public function products(){
        return $this->belongsTo(ProductsModel::class,'product_id','product_id');
    }
}
