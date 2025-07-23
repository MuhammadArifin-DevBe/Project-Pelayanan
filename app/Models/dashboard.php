<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class dashboard extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'qty',
        'jumlah',
    ];
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
