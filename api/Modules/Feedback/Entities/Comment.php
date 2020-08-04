<?php

namespace Modules\Feedback\Entities;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id','shop_id','comment'];
}
