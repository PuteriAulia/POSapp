<?php

namespace App\Models;

use App\Models\ProductsModel;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class CartModel extends Model
{
    use HasFactory;
    protected $table = 'cart';
    protected $fillable = [
        'user_id',
        'product_id',
        'transaction_id',
        'product_qty',
        'product_subtotal',
    ];

    public function products(){
        return $this->belongsTo(ProductsModel::class,'product_id','product_id');    
    }

    public function transaction(){
        return $this->belongsTo(TransactionModel::class,'transaction_id','transaction_id');    
    }
}
