<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Jurusan extends Model
{
    protected $guarded = [];

    public function kelas()
    {
        return $this->belongsToMany(Kelas::class,'kelas_jurusans');
    }

    public function kelas_jurusan()
    {
        return $this->hasMany(KelasJurusan::class);
    }
}
