<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RequisitionItem extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'requisition_id', 'qty', 'unit', 'description'
    ];

    public function requisition()
    {
        return $this->belongsTo('App\Requisition');
    }
}
