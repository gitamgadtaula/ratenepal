<?php

namespace Modules\Feedback\Entities;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'shop_id', 'comment'];

    public function users()
    {
        return $this->belongsTo(\app\User::class);
    }
    public function shops()
    {
        return $this->belongsTo(\Modules\Shop\Entities\Shop::class);
    }
    public function replies()
    {
        return $this->hasMany(\Modules\Feedback\Entities\Reply::class);
    }
}
