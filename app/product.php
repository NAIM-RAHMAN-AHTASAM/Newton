<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{

protected $guarded = [];

function get_multiple_photos (){
  return $this->hasMany('App\Product_multiple_image','product_id','id');
}
}
