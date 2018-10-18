<?php

namespace solider\Http\Controllers\telephone;

use solider\Http\Controllers\ApiController;
use solider\Telephone;
use Illuminate\Http\Request;

class TelephoneController extends ApiController
{

    public function __construct () {
         $this->middleware('jwt');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return $this->showAll(Telephone::all());
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Telephone $telephone)
    {
        return $this->showOne($telephone);
    }

}
