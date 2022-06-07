<?php

namespace App\Http\Controllers;

use App\Models\Operator;
use Illuminate\Http\Request;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Operator::orderBy('id', 'DESC')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       
        $request->validate([
            'operator_name' => 'string|required',
            'address' => 'string|required',
            'contact_no' => 'string|required',
           
        ]);

        
        $operator = Operator::create($request->only('operator_name', 'address', 'contact_no'));


        return response()->json($operator);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Operator  $operator
     * @return \Illuminate\Http\Response
     */
    public function show(Operator $operator)
    {
        return response()->json($operator);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Operator  $operator
     * @return \Illuminate\Http\Response
     */
    public function edit(Operator $operator)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Operator  $operator
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Operator $operator)
    {
        $operator->update($request->only('profile_image', 'operator_name', 'address', 'contact_no'));

    
        //change     
        if($request->hasFile('profile_image')){
  
          $destination = '/images/operatorsavatar/'.$operator->profile_image;
          if(File::exists($destination)){
              File::delete($destination);
          }
          $file = $request->file('profile_image');
          $extention = $file->getClientOriginalExtension();
          $filename = time().'.'. $extention;
          $file->move('/images/operatorsavatar/', $filename);
          $operator->profile_image = $filename;
        
        }
  
        $operator->update();
        return response()->json($operator);

       

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Operator  $operator
     * @return \Illuminate\Http\Response
     */
    public function destroy(Operator $operator)
    {
       
        $operator_name = $operator->operator_name;

        $operator->delete();

        return response()->json([
            'deleted' => true,
            'message' =>"Operator has been deleted."
        ]);
    }
}
