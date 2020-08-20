<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Category extends Model
{
   use SoftDeletes;
protected $guarded = [];




function connect_to_user_table()
{
  return $this->belongsTo('App\user','added_by');
}

function connect_to_priduct_table()
{
  return $this->hasMany('App\product');
}

}
