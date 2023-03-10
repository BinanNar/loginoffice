<?php

namespace App\Http\Controllers;

use SpaanProductions\Office365\Facade\Office365;

class AuthController extends Controller
{
    public function signin()
    {

        
        $link = Office365::login();
        return response()->json(
            ["link"=> $link]);
    }

    public function redirect()
    {
      
        if (!request()->has('code')) {
            
            abort(500);
        }
        $code = Office365::getAccessToken(request()->get('code'));

        //print_r($code);
        
        $user = Office365::getUser($code['token']);


        
        //print_r($user->getMail());

        //$messages = Office365::getEmails($code['token']);
       //print_r(!request());
        //dd($user, $messages);

        return redirect("http://localhost:8080/logged?nombre=".$user->getDisplayName());
        /*
        return response()->json(
            ["code"=> $code,
            "email"=>$user->getMail()]);*/
    }

    public function logout()
    {   

        /*
        dar de baja la secion wow
        */
        //print_r(!request());
        //print_r("ya te saliste");
        return redirect("http://localhost:8080");
        //$estado = Office365::getState();
        //print_r($estado);
    }
}