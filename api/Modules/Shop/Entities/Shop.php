<?php

namespace Modules\Shop\Entities;

use Illuminate\Database\Eloquent\Model;
use App\Http\Controllers\Auth;

class Shop extends Model
{
  protected $fillable = [
    'name', 'motto',
    'website', 'description', 'email', 'location', 'phone1', 'phone2', 'logo', 'user_id','main_img'
  ];

  public function images()
  {
    return $this->hasOne(\Modules\Shop\Entities\Image::class);
  }
  public function ratings()
  {
    return $this->hasMany(\Modules\Feedback\Entities\Rating::class);
  }

  public function users()
  {
    return $this->belongsTo(\Modules\User\Entities\User::class);
  }

  public function comments()
  {
    return $this->hasMany(\Modules\Feedback\Entities\Comment::class);
  }
}
