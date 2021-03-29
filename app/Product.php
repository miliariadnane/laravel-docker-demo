<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name',
        'description',
        'price',
        'sale_price',
        'product_quantity'
    ];

    public function user() {
        return $this->belongsTo(User::class);
    }
}
