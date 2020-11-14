<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
use App\models\Kelas;
use Illuminate\Http\Request;

class SearchJurusan extends Controller
{
    public static function search(Request $kelas)
    {
        $kelas = Kelas::find($kelas);

        if(count($kelas) > 0){
            $jurusans = $kelas->load('jurusan');
            return response()->json($jurusans);
        }

        return response()->json([],404);
    }
}
