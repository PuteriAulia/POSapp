<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsModel extends Model
{
    use HasFactory;
    protected $table = 'products';
    protected $fillable = ['product_id','product_name','product_stock','product_purchase_price','product_sell_price'];

    public function suppliers(){
        return $this->belongsTo(SuppliersModel::class,'supplier_id','supplier_id');
    }

    public function productsIn(){
        return $this->hasMany(ProductsInModel::class,'product_id','product_id');
    }

    public function productsOut(){
        return $this->hasMany(ProductsOutModel::class,'product_id','product_id');
    }

    public function transactionDetail(){
        return $this->hasMany(TransactionDetailModel::class,'product_id','product_id');
    }

    public function cart(){
        return $this->hasMany(CartModel::class,'product_id','product_id');
    }
}
