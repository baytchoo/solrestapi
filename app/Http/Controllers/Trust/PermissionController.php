<?php

namespace App\Http\Controllers\Trust;

use App\Http\Controllers\ApiController;
use App\Permission;
use Illuminate\Http\Request;

class PermissionController extends ApiController
{
    public function __construct () {
         $this->middleware(['jwt'  , 'admin']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->showAll(Permission::all());
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = [
            'name' => 'required',
            'display_name' => 'required',
        ];

        $this->validate($request, $rules);

        $permission = Permission::create($request->all());
        return $this->showOne($permission);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Permission $permission)
    {
        return $this->showOne($permission);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permission $permission)
    {
        $permission->fill($request->only([
            'name',
            'display_name',
            'description'
        ]));

        if ($permission->isClean()) {
            return $this->errorResponse('No changes detected to edit the resource!.', 422);
        }
        
        $permission->save();

        return $this->showOne($permission);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permission $permission)
    {
        $permission->delete();
        return $this->showOne($permission);
    }
}
