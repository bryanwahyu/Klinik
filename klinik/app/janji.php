<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class janji extends Model
{
    protected $guarded=[];
    public function dokter()
    {
        return $this->belongsTo(dokter::class);
    }
    public function pasien()
    {
        return $this->belongsTo(pasien::class);
    }    
}
