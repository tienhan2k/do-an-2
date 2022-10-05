<?php

namespace App\Models;

use App\Models\OrderItems;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory;
    protected $table = 'orders';
    protected $fillable = [
        'user_id',
        'name',
        'email',
        'phone',
        'address',
        'city',
        'province',
        'district',
        'message',
        'total_price',
        'status',
        'tracking_no',
    ];

    public function orederItems()
    {
        return $this->hasMany(OrderItems::class);
    }
}
