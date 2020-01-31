<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Po extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'po_num', 'po', 'issuance_num', 'po_date', 'released_by', 'supplier', 'received_by', 'endorsed_to', 'filename'
    ];

    public function po_items()
    {
        return $this->hasMany('App\PoItem');
    }
}
