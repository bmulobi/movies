<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    protected $name = 'categories';

    protected $fillable = [
        'name',
        'description',
    ];

    public function movies() {
        return $this->hasMany(Movies::class);
    }



}
