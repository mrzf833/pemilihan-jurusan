<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helper\CekPembagianJurusan;
use App\models\Jurusan;
use App\models\Kelas;
use App\models\KelasJurusan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PembagianJurusanController extends Controller
{
    public function index()
    {
        $kelas_jurusans = KelasJurusan::with('kelas','jurusan')->get();
        $jurusans = Jurusan::get();
        $kelas = Kelas::get();

        return view('pembagian_jurusan.index',[
            'kelas_jurusans' => $kelas_jurusans,
            'jurusans' => $jurusans,
            'kelas' => $kelas
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'kelas' => 'required|exists:kelas,id',
            'jurusan' => 'required|exists:jurusans,id',
        ]);

        $cek_kelas_jurusan = CekPembagianJurusan::cekPembagianJurusan('kelas_jurusans',['kelas_id' => $request->kelas,'jurusan_id' => $request->jurusan],null);
        if($cek_kelas_jurusan) return redirect()->route('admin.pembagian_jurusan.index')->with([
            'message' => 'data sudah ada',
            'status' => 422
        ]);

        DB::beginTransaction();
        try{
            $kelas_jurusans = KelasJurusan::create([
                'kelas_id' => $request->kelas,
                'jurusan_id' => $request->jurusan
            ]);
            DB::commit();
            return redirect()->route('admin.pembagian_jurusan.index');
        }catch(Exception $e){
            DB::rollBack();
            return abort(500,$e->getMessage());
        }
    }

    public function edit(Request $request,KelasJurusan $kelas_jurusan)
    {
        $this->validate($request,[
            'kelas' => 'required|exists:kelas,id',
            'jurusan' => 'required|exists:jurusans,id',
        ]);

        $cek_kelas_jurusan = CekPembagianJurusan::cekPembagianJurusan('kelas_jurusans',['kelas_id' => $request->kelas,'jurusan_id' => $request->jurusan],$kelas_jurusan->id);

        if($cek_kelas_jurusan) return redirect()->route('admin.pembagian_jurusan.index')->with([
            'message' => 'data sudah ada',
            'status' => 422
        ]);

        DB::beginTransaction();
        try{
            $kelas_jurusan->update([
                'kelas_id' => $request->kelas,
                'jurusan_id' => $request->jurusan
            ]);
            DB::commit();
            return redirect()->route('admin.pembagian_jurusan.index');
        }catch(Exception $e){
            DB::rollBack();
            return abort(500,$e->getMessage());
        }
    }

    public function destroy(KelasJurusan $kelas_jurusan)
    {
        DB::beginTransaction();
        try{
            $kelas_jurusan->delete();
            DB::commit();
            return redirect()->route('admin.pembagian_jurusan.index');
        }catch(Exception $e){
            DB::rollBack();
            return abort(500,$e->getMessage());
        }
    }    
}
