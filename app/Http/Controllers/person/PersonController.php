<?php

namespace solider\Http\Controllers\person;

use solider\Http\Controllers\ApiController;
use solider\Person;
use Illuminate\Http\Request;

class PersonController extends ApiController
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
        $persons= Person::with(['telephones','address'])->get();
        return $this->showAll($persons);
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
            'first_name' =>'required',
            'last_name' =>'required',
            'cin' =>'required', 
            'email' =>'required|email',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $person = Person::create($data);

        return $this->showOne($person);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Person $person)
    {
        $person->load('telephones','address');
        return $this->showOne($person);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Person $person)
    {
        $rules = [ 
            'email' =>'email',
        ];
        // check of validation
        $this->validate($request, $rules);
        $person->fill($request->only([
            'title',
            'first_name',
            'last_name',
            'cin', 
            'email',
        ]));

        // if ($request->has('title')) {
        //     $person->title = $request->title;
        // }

        // if ($request->has('first_name')) {
        //     $person->first_name = $request->first_name;
        // }

        // if ($request->has('last_name')) {
        //     $person->last_name = $request->last_name;
        // }

        // if ($request->has('cin')) {
        //     $person->cin = $request->cin;
        // }

        // if ($request->has('email')) {
        //     $person->email = $request->email;
        // }

        // wenn user not changed
        if($person->isClean()){
            return $this->errorResponse('No changes detected', 422);
        }

        $person->save();

        return $this->showOne($person);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person)
    {
        $person->delete();

        return $this->showOne($person);
    }
}
