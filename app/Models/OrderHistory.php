<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'falkutas',
        'npm',
        'product_id',
        'qty',
        'jumlah',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
