<?php

namespace Modules\Shop\Entities;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = ['shop_id', 'main_img', 'img1', 'img2', 'img3', 'img4'];
    public function shops()
    {
        return $this->belongs(\Modules\Shop\Entities\Shop::class);
    }
}
