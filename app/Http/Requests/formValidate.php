<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Validator;

class formValidate extends FormRequest
{
    public function formValidator($data)
    {
        $validator = Validator::make($data,[
            'pincode' => 'required',
            'name' => 'required',
            'email'=> 'required|email'
        ]);
        return $validator;
    }

        
  
}
