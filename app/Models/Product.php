<?php

namespace App\Models;

use App\Models\ProductSize;
use App\Models\SubCategory;
use App\Models\ProductColor;
use App\Models\ProductImage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'brand',
        'small_description',
        'description',
        'original_price',
        'sale_price',
        'quantity',
        'trending',
        'featured',
        'status',
        'meta_description',
        'meta_keyword',
        'meta_title',
    ];

    public function category()
    {
       return $this->belongsTo(SubCategory::class, 'category_id', 'id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }

    public function productColor()
    {
        return $this->hasMany(ProductColor::class, 'product_id', 'id');
    }

    public function productSizes()
    {
        return $this->hasMany(ProductSize::class, 'product_id', 'id');
    }

}
