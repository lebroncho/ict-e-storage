<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Other extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'title', 'filename', 'created_at'
    ];
}
