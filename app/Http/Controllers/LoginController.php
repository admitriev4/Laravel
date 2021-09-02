<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    /**
     * Log in to site.
     *
     * @return Response
     */
    public static function login($id)
    {
        $req = Auth::loginUsingId($id, $remember = true);
        return  $req;
    }


    /**
     * Log out from site.
     *
     * @return Response
     */
    public  static function logout()
    {
        Auth::logout();

        return view('main', [
            'title' => "Войдите или зарегистрируйтесь",

        ]);
    }


}
