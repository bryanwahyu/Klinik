<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class obat extends Model
{
    protected $guarded=[];

    public function stok()
    {
        return $this->hasmany(stok::class);
    }
    public function transaksi()
    {
        return $this->hasmany(transaksi::class);
    }
}
