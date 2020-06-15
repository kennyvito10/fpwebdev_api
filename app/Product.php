<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'productName', 'price','imgUrl', 'brand_id', 'description'
   ];

   protected $primaryKey = 'productid';

}
