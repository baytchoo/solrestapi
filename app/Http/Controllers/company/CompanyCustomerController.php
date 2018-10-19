<?php

namespace solider\Http\Controllers\company;

use Illuminate\Http\Request;
use solider\Company;
use solider\Customer;
use solider\Http\Controllers\ApiController;

class CompanyCustomerController extends ApiController
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
    public function store(Request $request, Company $company)
    {

        if(Customer::where('customerable_type', Company::class)->where('customerable_id', $company->id)->first()){
            return $this->errorResponse('company is already a customer', 400);
        }

        $customer = $company->customer()->create($request->all());

        return $this->showOne($customer);
    }
}
