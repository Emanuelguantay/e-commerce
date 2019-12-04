<?php

namespace App\Policies;

use App\User;
use App\Role;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function opt_for_product (User $user){
        dd($user->role_id);
        return $user->role_id == Role::CLIENTE;

    }

}
