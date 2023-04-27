<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class TransactionModel extends Model
{
    use HasFactory;
    protected $table = 'transaction';
    protected $fillable = [
        'transaction_id',
        'transaction_date',
        'transaction_total',
        'transaction_disc',
        'transaction_grand_total',
        'user_id'
    ];

    public function user(){
        return $this->belongsTo(User::class,'user_id','id');
    }

    public function transactionDetail(){
        return $this->hasMany(TransactionDetailModel::class,'transaction_id','transaction_id');
    }

    public function dateFormat(){
        return Carbon::parse($this->transaction_date)->translatedFormat('d F Y');
    }
}
