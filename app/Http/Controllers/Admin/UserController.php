<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Role;
use App\Member;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.manage.users.index', compact('users'));
    }

    private function memberList()
    {
        return Member::all()->reduce(function($list, $member) {
            $list[$member->id] = $member->full_name.' ('.$member->id.')';
            return $list;
        }, [ null ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $members = $this->memberList();
        $roles = Role::all()->pluck('display_name', 'id')->toArray();

        return view('admin.manage.users.create',
                    compact('roles', 'members'));
    }

    private function createUser(UserRequest $request)
    {
        $user = new User($request->all());
        $this->setMember($user, $request);
        $this->setPassword($user, $request->input('password'));
        $this->syncRoles($user, $request->input('role_list', []));
        $user->save();
        return $user;
    }

    private function setMember(User $user, UserRequest $request)
    {
        if ($memberId = $request->input('member'))
            $user->member()->save(Member::findOrFail($memberId));
        else
            $user->member()->delete();
    }

    private function setPassword(User $user, $password)
    {
        $user->password = bcrypt($password);
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
        $this->validate($request, [
            'password' => 'required'
        ]);

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
        $members = $this->memberList();
        $roles = Role::all()->pluck('display_name', 'id')->toArray();

        return view('admin.manage.users.edit',
                    compact('user', 'roles', 'members'));
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
        if ($password = $request->input('password'))
            $this->setPassword($user, $password);
        $this->syncRoles($user, $request->input('role_list', []));
        $this->setMember($user, $request);
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
