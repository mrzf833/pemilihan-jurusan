<?php

namespace App\Http\Controllers;

use App\models\Jurusan;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JurusanController extends Controller
{
    public function index()
    {
        $jurusans = Jurusan::get();

        return view('jurusan.index',[
            'jurusans' => $jurusans
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'jurusan' => 'required',
            'description' => 'required'
        ]);

        DB::beginTransaction();
        try{
            $jurusan = Jurusan::create([
                'jurusan' => $request->jurusan,
                'description' => $request->description
            ]);

            DB::commit();
            return redirect()->route('admin.jurusan.index');
        }catch(Exception $e){
            DB::rollBack();
            return abort(500,$e->getMessage());
        }
    }

    public function edit(Request $request,Jurusan $jurusan)
    {
        $this->validate($request,[
            'jurusan' => 'required',
            'description' => 'required'
        ]);

        DB::beginTransaction();
        try{
            $jurusan->update([
                'jurusan' => $request->jurusan,
                'description' => $request->description
            ]);
            DB::commit();
            return redirect()->route('admin.jurusan.index');
        }catch(Exception $e){
            DB::rollBack();
            return abort(500,$e->getMessage());
        }
    }

    public function destroy(Jurusan $jurusan)
    {
        DB::beginTransaction();
        try{
            $jurusan->delete();
            DB::commit();
            return redirect()->route('admin.jurusan.index');
        }catch(Exception $e){
            DB::rollBack();
            return abort(500,$e->getMessage());
        }
    }
}
