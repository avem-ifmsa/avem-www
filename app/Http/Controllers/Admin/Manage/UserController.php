<?php

namespace App\Http\Controllers\Admin\Manage;

use App\User;
use App\Role;
use App\Member;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.manage.users.index', [
            'users' => User::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.manage.users.create', [
            'roles' => Role::all()->pluck('display_name', 'id')->toArray()
        ]);
    }

    private function createUser(UserRequest $request)
    {
        $user = new User($request->all());
        $this->syncRoles($user, $request->input('role_list', []));
        $user->save();
        return $user;
    }

    private function syncRoles(User $user, array $roles)
    {
        $user->roles()->sync($roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->validate($request, [ 'password' => 'required' ]);
        $this->createUser($request);

        flash()->success(trans('admin.manage.users.create.successMessage'));
        return redirect()->route('admin.manage.users.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all()->pluck('display_name', 'id')->toArray();
        return view('admin.manage.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, UserRequest $request)
    {
        $user->update($request->all());
        $this->syncRoles($user, $request->input('role_list', []));
        $user->save();

        flash()->success(trans('admin.manage.users.edit.successMessage'));
        return redirect()->route('admin.manage.users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        flash()->success(trans('admin.manage.users.delete.successMessage'));
        return redirect()->route('admin.manage.users.index');
    }
}
