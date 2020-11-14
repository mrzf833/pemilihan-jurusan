<?php

namespace App\Http\Controllers\Siswa;

use App\Http\Controllers\Controller;
use App\models\Kelas;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        return view('siswa.profile');
    }

    public function show()
    {
        return view('siswa.edit_profile');
    }

    public function pemilihanJurusan()
    {
        $user = auth()->user();
        $kelas = Kelas::findOrFail($user->user_profile->kelas_id);
        $jurusan = $kelas->jurusan;
        return view('siswa.pemilihan_jurusan',[
            'jurusans' => $jurusan
        ]);
    }

    public function edit(Request $request)
    {
        $id = auth()->id();
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'name' => 'required',
            'fullname' => 'required',
            'password' => 'nullable'
        ]);

        DB::beginTransaction();
        try{
            $user = User::findOrFail($id);
            $user->update([
                'name' => $request->name,
                'email' => $request->email,
            ]);

            if(!empty($request->password)){
                $user->update([
                    'password' => bcrypt($request->password)
                ]);
            }

            $user->user_profile->update([
                'fullname' => $request->fullname
            ]);
            DB::commit();
            return redirect()->route('siswa.profile');
        }catch(Exception $e){
            DB::rollBack();
            return abort(500,$e->getMessage());
        }
    }

    public function jurusan(Request $request)
    {
        $this->validate($request,[
            'jurusan' => 'required'
        ]);
        $user = auth()->user();
        $kelas = Kelas::findOrFail($user->user_profile->kelas_id);
        $jurusan = $kelas->kelas_jurusan->find($request->jurusan);
        if($jurusan == null){
            abort(404);
        }
        DB::beginTransaction();
        try{
            $user->user_profile->update([
                'kelas_jurusan_id' => $request->jurusan
            ]);
            DB::commit();
            return redirect()->route('siswa.pemilihanJurusan');
        }catch(Exception $e){
            DB::rollBack();
            return abort(500,$e->getMessage());
        }
    }
}
