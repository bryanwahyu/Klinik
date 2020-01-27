<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class jadwal extends Model
{
    protected $guarded=[];

    public function dokter()
    {
        return $this->belongsTo(dokter::class);
    }
}
