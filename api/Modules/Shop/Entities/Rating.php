<?php

namespace Modules\Shop\Entities;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['user_id','shop_id','rating'];
}
