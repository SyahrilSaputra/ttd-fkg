<?php

namespace App\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use App\Http\Requests\Dashboard\RoleRequest;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function index()
    {
        $data = [
            'role' => Role::all()->toArray(),
        ];
        return view('dashboard.role.index', $data);
    }
    public function create()
    {
        $data = [
            'permission' => Permission::all()->toArray(),
        ];
        return view('dashboard.role.create', $data);
    }
    public function store(RoleRequest $request)
    {
        DB::beginTransaction();
        try {
            $dataRole = [
                'name' => $request->name,
            ];
            $role = Role::create($dataRole);
            $role->syncPermissions($request->permission);
            DB::commit();
            return redirect()->route('role')->with('status', 'Berhasil menambahkan role');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function edit($id)
    {
        $data = [
            'role' => Role::whereId($id)->first()->toArray(), 
            'permission' => Permission::all()->toArray(),
            'rolePermissions' => DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
            ->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
            ->all(),
        ];
        return view('dashboard.role.edit', $data);
    }
    public function update(RoleRequest $request, $id)
    {
        DB::beginTransaction();
        try {
            $role = Role::find($id);
            $role->name = $request->name;
            $role->save();
            $role->syncPermissions($request->permission);
            DB::commit();
            return redirect()->route('role')->with('status', 'Berhasil mengubah role');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
    public function delete($id)
    {
        DB::beginTransaction();
        try {
            Role::whereId($id)->delete();
            DB::commit();
            return redirect()->route('role')->with('status', 'Berhasil menghapus role');
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }
}
