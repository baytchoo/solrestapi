<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\ApiController;
use App\Role;
use App\User;
use Illuminate\Http\Request;

class UserRoleController extends ApiController
{

    public function __construct () {
         $this->middleware(['jwt'  , 'admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user)
    {
        return $this->showAll($user->roles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, Role $role)
    {
        $user->roles()->syncWithoutDetaching([$role->id]); 
        $user->flushCache();
        return $this->showAll($user->roles);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Role $role)
    {
        if ( !$user->hasRole([$role->name])){
            return $this->errorResponse('the specified role is not attached with the given user!.', 404);
        }

        $user->detachRole($role);
        $user->flushCache();

        return $this->showOne($role);
    }
}
