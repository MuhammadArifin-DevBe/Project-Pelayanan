<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
     protected $fillable = [
    'nama',
    'harga',
     ];
     public function dashboards()
    {
        return $this->hasMany(dashboard::class);
    }
}


