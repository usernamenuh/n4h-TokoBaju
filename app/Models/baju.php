<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class baju extends Model
{
    protected $table = 'bajus';
    protected $fillable = ['name', 'type', 'size', 'image', 'description', 'price', 'stock', 'status'];

}
