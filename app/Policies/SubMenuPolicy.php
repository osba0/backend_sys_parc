<?php

namespace App\Policies;

use App\Models\User;
use App\Models\SousMenu;
use Illuminate\Auth\Access\HandlesAuthorization;

class SubMenuPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        $perms = $user->role->permissions->all();

        foreach($perms as $perm) {
            if($perm->name == 'SubMenu-create') {
                return true;
            }
        }
        return false;
    }

    public function edit(User $user) {
        $perms = $user->role->permissions->all();

        foreach($perms as $perm) {
            if($perm->name == 'SubMenu-edit') {
                return true;
            }
        }

        return false;
    }

    public function delete(User $user, SousMenu $menu)
    {
        $perms = $user->role->permissions->all();

        foreach($perms as $perm) {
            if($perm->name == 'SubMenu-delete') {
                return true;
            }
        }

        return false;
    }
}
