<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $guarded = [''];
    const STATUS_ACTIVE = 1;
    const STATUS_HIDE = 0;

    public function products()
    {
        return $this->hasMany(Product::class,'pro_category_id');
    }
}
