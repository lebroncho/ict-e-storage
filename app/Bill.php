<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'bill_name', 'received_date', 'requested_by', 'soa_num', 'acc_num', 'statement_date', 'amount', 'filename'
    ];
}
