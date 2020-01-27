<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class rekam_medis extends Model
{
    protected  $guarded =[];

    public function pasien()
    {
        return $this->belongsTo(pasien::class);
    }
    public function dokter()
    {
        return $this->belongsTo(dokter::class);
        
    }
}
