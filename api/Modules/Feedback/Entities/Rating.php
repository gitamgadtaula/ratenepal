<?php

namespace Modules\Feedback\Entities;

use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    protected $fillable = ['user_id','shop_id','rating'];


    public function shops()
    {
      return $this->belongsTo(\Modules\Shop\Entities\Shop::class);
    }

    public function users()
    {
      return $this->belongsTo(\Modules\User\Entities\User::class);
    }


}