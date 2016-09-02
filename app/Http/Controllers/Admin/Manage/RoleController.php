<?php

namespace App\Http\Controllers\Admin\Manage;

use App\Role;
use App\Permission;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RoleRequest;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('admin.manage.roles.index', compact('roles'));
    }

    private function permissionList()
    {
        return Permission::all()->pluck('display_name', 'id')->toArray();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = $this->permissionList();
        return view('admin.manage.roles.create', compact('permissions'));
    }

    private function createRole(RoleRequest $request)
    {
        $role = Role::create($request->all());
        $this->syncPermissions($role, $request->input('perm_list', []));
        return $role;
    }

    private function syncPermissions(Role $role, array $perms)
    {
        $role->perms()->sync($perms);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RoleRequest $request)
    {
        $role = $this->createRole($request);
        flash()->success(trans('admin.manage.roles.create.successMessage'));
        return redirect()->route('admin.manage.roles.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = $this->permissionList();
        return view('admin.manage.roles.edit', compact('role', 'permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Role $role, RoleRequest $request)
    {
        $role->update($request->all());
        $this->syncPermissions($role, $request->input('perm_list', []));

        flash()->success(trans('admin.manage.roles.edit.successMessage'));
        return redirect()->route('admin.manage.roles.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        /**
         * Upstream BUG: see https://github.com/Zizaco/entrust/issues/472
         *
         * $role->delete();
         */
        $tableName = config('entrust.roles_table');
        \DB::delete('delete from '.$tableName.' where id = ?', [$role->id]);

        flash()->success(trans('admin.manage.roles.delete.successMessage'));
        return redirect()->route('admin.manage.roles.index');
    }
}
