<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PettyCash extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'pc_num', 'date_requested', 'requested_by', 'filename'
    ];

    public function petty_cash_items()
    {
        return $this->hasMany('App\PettyCashItem');
    }
}
