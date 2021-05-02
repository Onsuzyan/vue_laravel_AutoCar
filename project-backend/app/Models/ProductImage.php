<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'products_images';
    protected $fillable = ['image', 'image_link' , 'product_id'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function owner() {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
