<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Memo extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'type', 'subject', 'from', 'to', 'noted_by', 'cc', 'date_received', 'filename'
    ];
}
