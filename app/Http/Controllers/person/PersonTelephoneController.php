<?php

namespace solider\Http\Controllers\person;

use Illuminate\Http\Request;
use solider\Http\Controllers\ApiController;
use solider\Person;
use solider\Telephone;

class PersonTelephoneController extends ApiController
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
        return $this->showAll($person->telephones);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Person $person)
    {
        $rules=[
            'type' => 'required|in:'. Telephone::TYPES_STRING,
            'nr' => 'required',
        ];

        $this->validate($request, $rules);

        $data = $request->all();

        $telephone = Telephone::create($data);
        $person->telephones()->save($telephone);

        return $this->showOne($telephone);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Person $person, Telephone $telephone)
    {
        if(! $person->telephones()->where('id', $telephone->id)->first()){
            return $this->errorResponse('No related telphone with this id for this person', 404);
        } 

         $rules=[
            'type' => 'required|in:'. Telephone::TYPES_STRING,
            'nr' => 'required',
        ];

        $this->validate($request, $rules);

        if ($request->has('type')) {
            $telephone->type = $request->type;
        }

        if ($request->has('nr')) {
            $telephone->nr = $request->nr;
        }

        if ($request->has('comment')) {
            $telephone->comment = $request->comment;
        }

        // wenn user not changed
        if($telephone->isClean()){
            return $this->errorResponse('No changes detected', 422);
        }

        $telephone->save();

        return $this->showOne($telephone);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Person $person, Telephone $telephone)
    {
        if(! $person->telephones()->where('id', $telephone->id)->first()){
            return $this->errorResponse('No related telphone with this id for this person', 404);
        }


        $telephone->delete();

        return $this->showOne($telephone);
    }
}
