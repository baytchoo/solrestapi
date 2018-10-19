<?php

namespace solider\Http\Controllers\person;

use Illuminate\Http\Request;
use solider\Customer;
use solider\Http\Controllers\ApiController;
use solider\Person;

class PersonCustomerController extends ApiController
{
    public function __construct () {
         $this->middleware('jwt');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Person $person)
    {

        if(Customer::where('customerable_type', Person::class)->where('customerable_id', $person->id)->first()){
            return $this->errorResponse('person is already a customer', 400);
        }

        $customer = $person->customer()->create($request->all());

        return $this->showOne($customer);
    }
}
