<?php

namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
  
class Product extends Model
{
    use HasFactory;
  
    protected $table='products';

    protected $fillable = [
        'title',
        'description',
        'stock',
        'price',
        'status',
        'image_path',
        'category_id',
        'title_id',
        'color_id',
        'size_id',
        'storage_id',
        'maker_id',
        'brand_id',
        'product_used_id',
        'company_id'
    ];
}
