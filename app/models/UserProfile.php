<?php

namespace App\models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function kelas_jurusan()
    {
        return $this->belongsTo(KelasJurusan::class);
    }
}
