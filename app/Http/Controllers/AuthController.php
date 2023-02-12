<?php

namespace App\Http\Controllers;

use SpaanProductions\Office365\Facade\Office365;

class AuthController extends Controller
{
    public function signin()
    {

        
        $link = Office365::login();
        //print_r($link);
        return redirect($link);
    }

    public function redirect()
    {
        //print_r("que honda bitches");
        if (!request()->has('code')) {
            
            abort(500);
        }
        

        $code = Office365::getAccessToken(request()->get('code'));

        

        $user = Office365::getUser($code['token']);
        //print_r($user);

        $messages = Office365::getEmails($code['token']);
       
        dd($user, $messages);
    }

    public function checa()
    {   
        $estado = Office365::getState();
        print_r($estado);
    }
}