<?php

namespace solider\Http\Controllers\address;

use solider\Address;
use solider\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class AddressController extends ApiController
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
        return $this->showAll(Address::all());
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Address $address)
    {
        return $this->showOne($address);
    }
}
