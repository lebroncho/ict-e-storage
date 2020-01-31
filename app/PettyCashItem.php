<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PettyCashItem extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'pc_id', 'explanation', 'amount'
    ];

    public function petty_cash()
    {
        return $this->belongsTo('App\PettyCash');
    }
}
