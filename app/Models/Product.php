<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'category_id',
        'price',
        'description'
    ];

    public function categories()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class);
    }

    // public function order()
    // {
    //     return $this->belongsToMany(Order::class, 'order_product')->using(OrderProduct::class)->withPivot('quantity')->withTimestamps();
    // }
}
