<?php

namespace solider\Http\Controllers\company;

use solider\Company;
use solider\Http\Controllers\ApiController;
use Illuminate\Http\Request;

class CompanyController extends ApiController
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
        $companies= Company::with(['telephones','address'])->get();
        return $this->showAll($companies);
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
            'company_name' => 'required',
            'tax_reg_nr' => 'required',
            'email' => 'required|email',
        ];

        $this->validate($request, $rules);

        $data = $request->only([
            'company_name',
            'tax_reg_nr',
            'business_reg_nr',
            'email',
        ]);

        $company = Company::create($data);

        return $this->showOne($company);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $company->load('telephones','address');
        return $this->showOne($company);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $rules = [ 
            'email' =>'email',
        ];
        // check of validation
        $this->validate($request, $rules);

        $company->fill($request->only([
            'company_name',
            'tax_reg_nr',
            'business_reg_nr',
            'email',
        ]));

        // wenn user not changed
        if($company->isClean()){
            return $this->errorResponse('No changes detected', 422);
        }

        $company->save();

        return $this->showOne($company);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $company->delete();

        return $this->showOne($company);
    }
}
