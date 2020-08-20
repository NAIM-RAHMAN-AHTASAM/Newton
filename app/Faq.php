<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Faq extends Model
{
 use SoftDeletes;
protected $fillable=['faq_question','faq_answer'];
}
