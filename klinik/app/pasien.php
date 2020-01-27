<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pasien extends Model
{
    protected $guarded=[];

    public function rekam()
    {
        return $this->hasMany(rekam_medis::class);
    }
}
