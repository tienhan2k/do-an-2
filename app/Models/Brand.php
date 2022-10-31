<?php

namespace App\Models;

use App\Models\SubCategory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;

    protected $table = 'brands';


    protected $fillable = [
        'name',
        // 'slug',
        'status',
        // 'category_id'
    ];

    // public function category()
    // {
    //    return $this->belongsTo(SubCategory::class, 'category_id', 'id');
    // }



}
