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
        $this->LoginController = new LoginController();
    }

    public function index(Request $request) {
        $auth = $this->LoginController->login($request);
        var_dump($auth);
        /*
        if() {
            $users = $this->model->getList();
            return view('user.users', [
                'title' => "Список пользователей",
                'users' => $users
            ]);
        }*/


    }
    public function userAdd(Request $request) {
        $res = $this->model->add($request);
        if(is_bool($res)) {
            $users = $this->model->getList();
            $user = $this->model->getUser('email', $request->email);
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

    public function userUpdate(Request $request) {
        $res = $this->model->updateInfo($request);
        var_dump($res);
        /*if(is_bool($res)) {
            $users = $this->model->getList();
            $user = $this->model->getUser('email', $request->email);
            return view('user.users', [
                'title' => "Список пользователей",
                'users' => $users
            ]);
        } else {
            return view('registration', [
                'title' => "Регистрация",
                'request' => $res
            ]);
        }*/
    }

    /*public function userUpdatePass(Request $request) {
        $res = $this->model->add($request);
        if(is_bool($res)) {
            $users = $this->model->getList();
            $user = $this->model->getUser('email', $request->email);
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

    public function userDelete(Request $request) {
        $res = $this->model->add($request);

        if(is_bool($res)) {
            $users = $this->model->getList();
            $user = $this->model->getUser('email', $request->email);

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
    }*/



}
