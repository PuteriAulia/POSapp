<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductsInModel extends Model
{
    use HasFactory;
    protected $table = 'products_in';
    protected $fillable = ['productIn_id','products_id','productsIn_qty','productsIn_date','productsIn_info'];

    public function products(){
        return $this->belongsTo(ProductsModel::class,'product_id','product_id');

    }
}
