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
    public function login($request)
    {

        $user = DB::table('users')
            ->select('id', 'email', 'password', 'remember_token')
            ->where('email', '=', $request->login)
            ->get();
        if(!$user->isEmpty()) {
            $user = $user[0];
            if($request->password == $user->password) {
               $req = Auth::loginUsingId($user->id, $remember = true);
            } else {
                $req = "Неверный пароль!";
            }
        }
        else {
            $req = "Введите логин правильно";
        }
        return $req;
    }


    /**
     * Log out from site.
     *
     * @return Response
     */
    public function logout()
    {
        Auth::logout();

        return view('main', [
            'title' => "Войдите или зарегистрируйтесь",

        ]);
    }


}
