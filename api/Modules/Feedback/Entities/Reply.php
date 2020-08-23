<?php

namespace Modules\Feedback\Entities;

use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    protected $fillable = ['user_id','comment_id','reply'];


    public function comments()
    {
      return $this->belongsTo(\Modules\Feedback\Entities\Comment::class);
    }

    public function users()
    {
      return $this->belongsTo(\Modules\User\Entities\User::class);
    }
}
