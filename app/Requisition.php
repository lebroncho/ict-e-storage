<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Requisition extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'purpose', 'requisition_date', 'requested_by', 'requisition_date', 'filename'
    ];

    public function requisition_items()
    {
        return $this->hasMany('App\RequisitionItem');
    }
}
