<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Helper\SearchJurusan;
use App\models\Kelas;
use App\models\Role;
use App\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('role','user_profile')->get();

        return view('user.index',[
            'users' => $users
        ]);
    }

    public function create()
    {
        $roles = Role::get();
        $kelass = Kelas::get();
        return view('user.create',[
            'roles' => $roles,
            'kelass' => $kelass
        ]);
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'role' => 'required|exists:roles,id',
            'name' => 'required',
            'email' => 'required|unique:users,email|email',
            'fullname' => 'required',
            'password' => 'required',
            'kelas' => 'nullable|exists:kelas,id',
            'kelas_jurusan' => 'nullable|exists:kelas_jurusans,id',
        ]);
        DB::beginTransaction();
        try{
            $user = User::create([
                'role_id' => $request->role,
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt($request->password)
            ]);

            $user->user_profile()->create([
                'fullname' => $request->fullname,
                'kelas_id' => $request->kelas,
                'kelas_jurusan_id' => $request->kelas_jurusan
            ]);

            DB::commit();
            return redirect()->route('admin.user.index');
        }catch(Exception $e){
            DB::rollBack();
            return abort(403,$e->getMessage());
        }
    }

    public function show(User $user)
    {
        $roles = Role::get();
        $kelass = Kelas::get();
        $request = new Request([
            'kelas' => $user->user_profile->kelas->id ?? null
        ]);
        $jurusan = SearchJurusan::search($request);
        if(!empty($jurusan)){
            $jurusan = json_decode(json_encode($jurusan));
            $jurusan = $jurusan->original[0]->jurusan;
        }
        return view('user.show',[
            'user' => $user,
            'roles' => $roles,
            'kelass' => $kelass,
            'jurusans' => $jurusan
        ]);
    }

    public function edit(Request $request,User $user)
    {
        $this->validate($request,[
            'role' => 'required|exists:roles,id',
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'fullname' => 'required',
            'kelas' => 'required|exists:kelas,id',
            'kelas_jurusan' => 'nullable|exists:kelas_jurusans,id',
        ]);
        DB::beginTransaction();
        try{
            $user->update([
                'role_id' => $request->role,
                'name' => $request->name,
                'email' => $request->email,
            ]);
            

            if(!empty($request->password)){
                $user->update([
                    'password' => bcrypt($request->password)
                ]);
            }

            $user->user_profile()->update([
                'fullname' => $request->fullname,
                'kelas_id' => $request->kelas,
                'kelas_jurusan_id' => $request->kelas_jurusan
            ]);

            DB::commit();
            return redirect()->route('admin.user.index');
        }catch(Exception $e){
            DB::rollBack();
            return abort(500,$e->getMessage());
        }
    }

    public function destroy(User $user)
    {
        DB::beginTransaction();
        try{
            $user->delete();
            DB::commit();
            return redirect()->route('admin.user.index');
        }catch(Exception $e){
            DB::rollBack();
            return abort(500,$e->getMessage());
        }
    }
}
