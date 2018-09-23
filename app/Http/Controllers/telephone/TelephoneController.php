<?php

namespace App\Http\Controllers\telephone;

use App\Http\Controllers\Controller;
use App\Telephone;
use Illuminate\Http\Request;

class TelephoneController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        error_log( " get "  );
        return response()->json(['data' => Telephone::all()], 200);
    }


    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */
    // public function store(Request $request)
    // {   
        
    //     $rules = [
    //         'type' => 'required',
    //         'nr' => 'required',
    //         'comment' => 'max:100',
    //         'telephoneable_id' => 'required',
    //         'telephoneable_type' => 'required',
    //     ];
    //     try {
            
    //          $this->validate($request, $rules);
    //          return response()->json(
    //                                 ['error' => 'no error', 'code' => 400]
    //                                 , 400);
    //     } catch (Exception $e) {
    //          return response()->json(
    //                                 ['error' => $e->getMessage() , 'code' => 400]
    //                                 , 400);
    //     }
    //     // check of validation
       

    //     // // get all data of request
    //     // $data = $request->all();

    //     // // create user
    //     // try {
    //     //      $telephone = Telephone::create($data);
    //     //      error_log( " tel created "  );
    //     //      return response()->json(['data' => $telephone], 201); // 201 means: has bean created
    //     // } catch (Exception $e) {
    //     //     error_log( " tel not created "  );
    //     //     return response()->json(
    //     //                             ['error' => $e->getMessage() , 'code' => 400]
    //     //                             , 400);
    //     // }
       

    //     //return response
        
    // }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return response()->json(['data' => Telephone::findOrFail($id)], 200);
    }

}
