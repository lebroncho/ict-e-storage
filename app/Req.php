<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Req extends Model
{
    protected $table = 'requests';

    public $timestamps = false;

    protected $fillable = [
        'requested_by', 'office', 'designation', 'request', 'date_requested', 'filename'
    ];
}
