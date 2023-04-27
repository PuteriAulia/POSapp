<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuppliersModel extends Model
{
    use HasFactory;
    protected $table = 'suppliers';
    protected $fillable = ['supplier_id','supplier_name','supplier_phone','supplier_address'];

    public function products(){
        return $this->hasMany(ProductsModel::class,'supplier_id','supplier_id');
    }
}
