<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    //
    protected $fillable = [
        'judul', 'tanggal', 'foto', 'konten'
    ];
}
