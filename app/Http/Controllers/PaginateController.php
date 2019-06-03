<?php

namespace App\Http\Controllers;
use App\Http\Requests\formValidate;
use Illuminate\Http\Request;
use App\Pincode;
class PaginateController extends Controller
{

   public function __construct()
    {
        $this->validation = new formValidate();
    }
 
    public function index()
    {

        return view('paginate.index');
    }

    public function insert(Request $request)
    {
        $input = $request->all();
        
        $validator = $this->validation->formValidator($input);
        
        if($validator->fails())
        {
            $response= array();
            $response['code'] = 404;
            $response['message']= $validator->errors()->first();
            return response()->json($response);
        }

        $pincode = new Pincode();
        $pincode->pincode = $input['pincode'];
        $pincode->name    = $input['name'];
        $pincode->nick    = $input['email'];

        $stat = 0;
        if(isset($input['status']))
        {
            $stat = 1;           
        }
        $pincode->pin_status =$stat;

        $pincode->save();

        $response=array();
        $response['code']=200;
        $response['message']='Form added successfully';
        return response()->json($response);
    }

    public function read()
    {
        $pincode = Pincode::paginate(5);
        // if ($request->ajax())
        // {
        //     $page = $request->get('page');
        //     $inp_query = $request->get('query');
        //     $key = $request->get('key');
        //     if(!empty($page) && empty($key))
        //     {
        //         $employee=$employee->where(function ($query) use ($inp_query) {
        //             $query->where('first_name','LIKE', "$inp_query%");
        //         });

        //     }
        //     else if(!empty($key))
        //     {
        //         $employee = $employee->where(function ($query) use($key){
        //                 $query->where('first_name','LIKE', "%$key%")
        //                  ->orwhere('last_name','LIKE', "%$key%");
        //                 });
        //     }
        //     $employee=$employee->paginate(12)->appends($inp_query);
        //     return view('modules.employee-directory.employee_paginate',compact('employee'));
        //  }
        //  else
        //  {
            // $employee = $employee->orderBy('users.id', 'desc')->paginate(12);
            // return view('modules.employee-directory.employee-directory-list',compact('employee'));
        /// }
    }
}
