<?php

namespace App\Http\Controllers\Trust;

use App\Http\Controllers\ApiController;
use App\Role;
use Illuminate\Http\Request;

class RoleController extends ApiController
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
        return $this->showAll(Role::all());
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

        $role = Role::create($request->all());
        return $this->showOne($role);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        return $this->showOne($role);
    }

    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $role->fill($request->only([
            'name',
            'display_name',
            'description'
        ]));

        if ($role->isClean()) {
            return $this->errorResponse('No changes detected to edit the resource!.', 422);
        }
        
        $role->save();

        return $this->showOne($role);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        $role->delete();
        return $this->showOne($role);
    }
}
