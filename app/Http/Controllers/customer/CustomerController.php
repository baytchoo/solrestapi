<?php

namespace solider\Http\Controllers\customer;

use Illuminate\Http\Request;
use solider\Company;
use solider\Customer;
use solider\Http\Controllers\ApiController;
use solider\Person;

class CustomerController extends ApiController
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
        // $customers= Customer::with(['customerable'])->get();
        $type = request()->type;
        if($type=='person'){
            return $this->showAll(Customer::where('customerable_type', Person::class)->orderBy('customerable_id', 'asc')->get());
        }

        if($type=='company'){
            return $this->showAll(Customer::where('customerable_type', Company::class)->orderBy('customerable_id', 'asc')->get());
        }

        return $this->showAll(Customer::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Customer $customer)
    {
        if(!$request->has('description') | ($customer->description == $request->description)){
            return $this->errorResponse('No changes detected', 422);
        }
        $customer->description = $request->description;
        $customer->save();
        return $this->showOne($customer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
        // $customer->load('customerable');
        return $this->showOne($customer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Customer $customer)
    {
        $customer->delete();
        return $this->showOne($customer);
    }
}
