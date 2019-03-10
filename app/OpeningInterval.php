<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OpeningInterval extends Model
{
    public $timestamps = false;

    protected $table = 'opening_interval';

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }
}
