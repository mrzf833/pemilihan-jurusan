<?php

namespace App\Http\Controllers\Helper;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CekPembagianJurusan extends Controller
{
    public static function cekPembagianJurusan($table,$datas,$id)
    {
        $tableData = DB::table($table);
        $data = $tableData->where(function($query) use ($datas){
            foreach($datas as $key => $value){
                $query->where($key,$value);
            }
        })->first();

        if($data && $data->id != $id){
            return true;
        }
        return false;
    }
}
