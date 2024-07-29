<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total_cost',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function orderProduct()
    {
        return $this->hasMany(OrderProduct::class);
    }

    // public function product()
    // {
    //     return $this->belongsToMany(Product::class, 'order_product')->withPivot('quantity')->withTimestamps();
    // }
}
