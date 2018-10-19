<?php

namespace solider\Http\Controllers\person;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use solider\Address;
use solider\Http\Controllers\ApiController;
use solider\Person;

class PersonAddressController extends ApiController
{
     public function __construct () {
         $this->middleware('jwt');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Person $person)
    {
            if($person->address){
                return $this->showOne($person->address); 
            }
            return response()->json(['data' => []],200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Person $person)
    {
        if($person->address) {
            return $this->errorResponse('person have already an address, please use the update option',404);
        }
        $rules=[
            'street' => 'required',
            'nr' => 'required|integer',
            'city' => 'required',
            'country' => 'required',
            'zip' => 'required|integer',
        ];

        $this->validate($request, $rules);


        $data = $request->all();

        $address = Address::create($data);
        $person->Address()->save($address);

        return $this->showOne($person->address);
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person, Address $address)
    {
        if(!$person->address)
        {
            return $this->errorResponse('person have no addresses',404);
        }

        if (!($person->address->id === $address->id))
        {
            return $this->errorResponse('this address is not related with the given person',404);
        }

        $rules=[
            'nr' => 'integer',
            'zip' => 'integer',
        ];

        $this->validate($request, $rules);

        $data = $request->only([
            'street',
            'nr',
            'city',
            'country',
            'zip',
            'comment',
            'lat',
            'lng',
        ]);


        $address->fill($data);
        if ($address->isClean()) {
            return $this->errorResponse('No changes detected to edit the resource!.', 422);
        }
        $address->save();

        return $this->showOne($address);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person, Address $address)
    {   
        if(!$person->address)
        {
            return $this->errorResponse('person have no addresses',404);
        }

        if (!($person->address->id === $address->id))
        {
            return $this->errorResponse('this address is not related with the given person',404);
        }

        $address->delete();

        return $this->showOne($address);
    }
}
