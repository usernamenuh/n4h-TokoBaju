<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pelanggan extends Model
{
    protected $table = 'pelanggans';
    protected $fillable = ['user_id', 'nama', 'email', 'no_hp'];

    public function user()
    {
        $this->hasOne(user::class);
    }
}
