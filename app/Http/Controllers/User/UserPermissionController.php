<?php

namespace solider\Http\Controllers\User;

use solider\Http\Controllers\ApiController;
use solider\Permission;
use solider\User;
use Illuminate\Http\Request;

class UserPermissionController extends ApiController
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
        return $this->showAll($user->allPermissions());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user, Permission $permission)
    {
        $user->permissions()->syncWithoutDetaching([$permission->id]); 
        $user->flushCache();

        return $this->showAll($user->permissions);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user, Permission $permission)
    {
        if ( !$user->hasPermission([$permission->name])){
            return $this->errorResponse('the specified permission is not attached with the given user!.', 404);
        }

        $user->detachRole($permission);
        $user->flushCache();

        return $this->showOne($permission);
    }
}
