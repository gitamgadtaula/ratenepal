<?php

namespace Modules\Shop\Entities;

use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    protected $fillable = ['name','motto','website','desc','location','contact','logo'];
}
