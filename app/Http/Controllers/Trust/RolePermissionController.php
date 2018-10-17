<?php

namespace App\Http\Controllers\Trust;

use App\Http\Controllers\ApiController;
use App\Permission;
use App\Role;
use Illuminate\Http\Request;

class RolePermissionController extends ApiController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Role $role)
    {
        return $this->showAll($role->permissions);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role, Permission $permission)
    {
        $role->permissions()->syncWithoutDetaching([$permission->id]); 
        $role->flushCache();
        return $this->showAll($role->permissions);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role, Permission $permission)
    {
         if ( !$role->hasPermission([$permission->name])){
            return $this->errorResponse('the specified permission is not attached with the given role!.', 404);
        }

        $role->detachPermission($permission);
        $role->flushCache();

        return $this->showOne($permission);
    }
}
