<?php

namespace App\Policies;

use App\Models\Categories;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CategoryPolicy
{
    public function before(User $user):bool|null
    {
        if($user->hasRole(["Developer"])){
            return true;
        }
        return null;
    }
   
    public function viewAny(User $user):bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     *
     */
    public function view(User $user, Categories $category):bool
    {
        if($user->hasPermissionTo('view category')){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can create models.
     *
     */
    public function create(User $user):bool
    {
        if($user->hasPermissionTo('create category')){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can update the model.
     *
     */
    public function update(User $user, Categories $category)
    {
        if($user->hasPermissionTo('update category')){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     *
     */
    public function delete(User $user, Categories $category)
    {
        if($user->hasPermissionTo('delete category')){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Determine whether the user can restore the model.
     *
     */

}
