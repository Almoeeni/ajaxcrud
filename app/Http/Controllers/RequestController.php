<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use cURLFile;
use Log;

class RequestController extends Controller
{
      public function sendRequest($data) 
    {     
       
        array_walk_recursive($data, function (&$item, $key) {
            $item = null === $item ? '' : $item;
        });
        $headers =  ["content-type: application/json"];
        if(isset($data['auth']) && $data['auth']==TRUE && !empty(session('token')))
        {
            $headers[] = "Authorization: token ".session('token');
        }
        else if(isset($data['data']['token']) && !empty($data['data']['token']))
        {
            $headers[] = "Authorization: token ".$data['data']['token'];
        }
        
        $headers[] = "User-IP: ".request()->ip();
        //dd($headers);
        $url = env('API_LINK').$data['uri'];
        //dd($url);
        $curl_data = array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $data['type'],  
            CURLOPT_HTTPHEADER => $headers,
        );
        if($data['type']=='POST')
        {
            $curl_data[CURLOPT_POSTFIELDS] =  json_encode($data['data']);
        }
        $curl = curl_init();
        curl_setopt_array($curl, $curl_data);

        $response = curl_exec($curl);
        
       //dd($response);
        
        $err = curl_error($curl);
        curl_close($curl);

        
        if ($err) {
            return $err;
        } else {
            return $response;
        }
    }

    public function make_request()
    {
         $input = request()->all();
         $num =$input['page1'];
        $data=[
            'uri' => 'pin?page='.$num,
            'type' => 'GET',
            'data' => ''
        ];
        $response = $this->sendRequest($data);
        return $response;
    }

    public function add()
    {
        $input = request()->all();
        $data=[
            'uri' => 'add',
            'type'=> 'POST',
            'data'=> $input
        ];
        $response = $this->sendRequest($data);
        return $response;
    }

    
    public function edit()
    {
        $input = request()->all();
     
        $data=[
            'uri' => 'edit',
            'type'=> 'POST',
            'data'=> $input
        ];
        $response = $this->sendRequest($data);
        return $response;
    }

    public function delete()
    {
        $input = request()->all();
        dd($input);
        $data=[
            'uri' => 'del',
            'type'=> 'POST',
            'data'=> $input
        ];
        $response = $this->sendRequest($data);
        return $response;
    }
}
