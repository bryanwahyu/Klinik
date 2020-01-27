<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class stok extends Model
{
    protected $guarded=[];

    public function obat()
    {
        return $this->belongsTo(obat::class);
    }
}
