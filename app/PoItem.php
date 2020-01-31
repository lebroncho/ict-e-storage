<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PoItem extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'po_id', 'qty', 'unit', 'description', 'price', 'amount'
    ];

    public function po()
    {
        return $this->belongsTo('App\Po');
    }
}
