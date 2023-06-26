<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\User\UserRequest;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $data = [
            'users' => User::all()->toArray(),
        ];

        return view('dashboard.user.index', $data);
    }
    public function create()
    {
        $data = [
            'roles' => Role::all()->toArray(),
        ];

        return view('dashboard.user.create', $data);
    }
    public function store(UserRequest $request)
    {
        DB::beginTransaction();
        try {
            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'username' => $request->username,
                'password' => bcrypt($request->password),
            ];

            $user = User::create($data);
            $user->assignRole($request->role);
            DB::commit();
            return redirect()->route('user')->with('status', 'Berhasil menambahkan user');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function edit($id)
    {
        $user = User::whereId($id)->first();
        $data = [
            'user' => $user->toArray(),
            'userRole' => $user->roles->pluck('id', 'id')->toArray(),
            'roles' => Role::all()->toArray(),
        ];
        return view('dashboard.user.edit', $data);
    }
    public function update(UserRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $user = User::find($id);
            $user->name = $request->name;
            $user->email = $request->email;
            $user->username = $request->username;
            if($request->password && $request->confirmPassword){
                $user->password = bcrypt($request->password);
            }
            $user->save();
            DB::table('model_has_roles')->where('model_id',$id)->delete();
            $user->assignRole($request->role);
            DB::commit();
            return redirect()->route('user')->with('status', 'Berhasil mengubah user');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
