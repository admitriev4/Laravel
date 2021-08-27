<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    function __construct()
    {
        $this->model = new User();
    }

    public function index() {

        $users = $this->model->getList();
        return view('user.users', [
            'title' => "Список пользователей",
            'users' => $users
        ]);

    }
    public function userAdd(Request $request) {
        $res = $this->model->add($request);
        var_dump($res);
        if(is_bool($res)) {
            $users = $this->model->getList();
            $user = $this->model->getUser('email', $request->email);
            var_dump($user);
            return view('user.users', [
                'title' => "Список пользователей",
                'users' => $users
            ]);
        } else {
            return view('registration', [
                'title' => "Регистрация",
                'request' => $res
            ]);
        }


    }



}
