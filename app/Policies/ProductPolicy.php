<?php

namespace App\Policies;

use App\User;
use App\Role;
use App\Product;
use Illuminate\Auth\Access\HandlesAuthorization;

class ProductPolicy
{
    use HandlesAuthorization;

    public function opt_for_product (User $user){
        dd($user->role_id);
        return $user->role_id == Role::CLIENTE;
    }

    public function review (User $user, Product $product){
        return ! $product->reviews->contains('user_id', $user->id);
    }

}
