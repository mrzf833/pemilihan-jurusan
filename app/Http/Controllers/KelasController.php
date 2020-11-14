<?php

namespace App\Http\Controllers;

use App\models\Kelas;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::get();
        // dd($kelas);
        return view('kelas.index',[
            'kelas' => $kelas
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'kelas' => 'required'
        ]);

        DB::beginTransaction();
        try{
            $kelas = Kelas::create([
                'kelas' => $request->kelas
            ]);
            DB::commit();
            return redirect()->route('admin.kelas.index');
        }catch(Exception $e){
            DB::rollBack();
            return abort(500,$e->getMessage());
        }
    }

    public function edit(Request $request,Kelas $kelas)
    {
        $this->validate($request,[
            'kelas' => 'required'
        ]);

        DB::beginTransaction();
        try{
            $kelas->update([
                'kelas' => $request->kelas
            ]);
            DB::commit();
            return redirect()->route('admin.kelas.index');
        }catch(Exception $e){
            DB::rollBack();
            return abort(500, $e->getMessage());
        }
    }

    public function destroy(Kelas $kelas)
    {
        DB::beginTransaction();
        try{
            $kelas->delete();
            DB::commit();
            return redirect()->route('admin.kelas.index');
        }catch(Exception $e){
            DB::rollBack();
            return abort(500,$e->getMessage());
        }
    }
}
