<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
  protected $guarded = [];

  function relationBetweenProduct()
  {

    return $this->belongsTo('App\product', 'product_id', 'id');
  }
}
