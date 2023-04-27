<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsOutModel extends Model
{
    use HasFactory;
    protected $table = 'products_out';
    protected $fillable = ['productOut_id','products_id','productsOut_qty','productsOut_date','productsOut_info'];

    public function products(){
        return $this->belongsTo(ProductsModel::class,'product_id','product_id');
    }
}
