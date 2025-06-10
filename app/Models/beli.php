<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class beli extends Model
{
    protected $table = 'belis';
    protected $fillable = ['jumlah', 'harga'];

    public function baju()
    {
        return $this->hasMany(baju::class);
    }
}
