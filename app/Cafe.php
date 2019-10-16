<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cafe extends Model
{
    protected $fillable = [
        'nama', 'lokasi', 'range_harga', 'foto', 'konten'
    ];
}
