<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class dokter extends Model
{
    protected $guarded=[];

    public function rekam()
    {
        return $this->hasmany(rekam_medis::class);
    }
    public function jadwal()
    {
        return $this->hasmany(jadwal::class);
    }
    public function janji()
    {
        return $this->hasMany(janji::class);
    }
}
