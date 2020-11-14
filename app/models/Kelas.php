<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    protected $guarded = [];

    public function jurusan()
    {
        return $this->belongsToMany(Jurusan::class,'kelas_jurusans')->withPivot('id');
    }

    public function kelas_jurusan()
    {
        return $this->hasMany(KelasJurusan::class);
    }

    public function user_profile()
    {
        return $this->hasMany(UserProfile::class);
    }
}
