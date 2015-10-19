<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $table = 'products';
    public static $tableName = 'Товары';

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function getImagesAttribute($value)
    {
        return unserialize($value);
    }
}
