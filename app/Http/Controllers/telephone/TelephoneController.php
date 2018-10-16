<?php

namespace App\Http\Controllers\telephone;

use App\Http\Controllers\ApiController;
use App\Telephone;
use Illuminate\Http\Request;

class TelephoneController extends ApiController
{
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
