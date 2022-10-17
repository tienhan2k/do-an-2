<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItems extends Model
{
    use HasFactory;
    protected $table = "order_items";
    protected $fillable = [
        'order_id',
        'product_id',
        'qty',
        'price',
    ];

    public function products(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function orders(): BelongsTo
    {
        return $this->belongsTo(Order::class, 'order_id', 'id');
    }

    // public function review()
    // {
    //     return $this->hasOne(Review::class);
    // }

}
