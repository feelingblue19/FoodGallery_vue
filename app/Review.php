<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    //
    protected $fillable = [
        'judul', 'lokasi', 'tanggal', 'harga', 'foto', 'konten'
    ];
}
