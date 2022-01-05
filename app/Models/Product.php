<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $table = "product";
    protected $fillable = [
        'category',
        'title',
        'description',
        'price',
        'stock',
        'image'
    ];

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
}
