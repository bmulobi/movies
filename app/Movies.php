<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Movies extends Model
{
    protected $name = 'movies';
    protected $fillable = [
        'title',
        'description',
        'actors',
        'url',
        'category',
        'popularity'
    ];


}
