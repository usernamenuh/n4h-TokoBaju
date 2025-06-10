<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class beli extends Model
{
    use HasFactory;
    protected $table = 'belis';
    protected $fillable = ['bajus_id','jumlah', 'harga'];

    public function baju()
    {
        return $this->hasMany(baju::class);
    }
}
