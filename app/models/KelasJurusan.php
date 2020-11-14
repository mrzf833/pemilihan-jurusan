<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class KelasJurusan extends Model
{
    protected $guarded = [];

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function user_profile()
    {
        return $this->hasMany(UserProfile::class);
    }
}
