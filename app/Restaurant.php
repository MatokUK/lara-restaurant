<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    public $timestamps = false;

    protected $table = 'restaurant';

    public function openingIntervals()
    {
        return $this->hasMany(OpeningInterval::class, 'restaurant_id', 'id');
    }
}
