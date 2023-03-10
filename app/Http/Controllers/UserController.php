<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Queue;
use App\Jobs\TestJob;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public $model;
    function __construct()
    {
        $this->model = new User();
        $this->LoginController = new LoginController();
    }

    public function index(Request $request) {
        $user = Auth::user();
        if (empty($user)) {
            $auth = $this->model->authorizationUser($request);
            if(!is_string($auth)) {
            $users = $this->model->getList();
            Queue::push(new TestJob('job работает'));
            return view('user.users', [
                'title' => "Список пользователей",
                'users' => $users
            ]);
        } else {
            return view('main', [
                'title' => "Войдите или зарегистрируйтесь",
                'request' => $auth,
            ]);
        }
        }else {
            $users = $this->model->getList();
            return view('user.users', [
                'title' => "Список пользователей",
                'users' => $users
            ]);
        }

        }
    public function userAdd(Request $request) {
        $res = $this->model->add($request);
        if(is_bool($res)) {
            $users = $this->model->getList();
            Queue::push(new TestJob('job работает'));
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
        if(is_int($res)) {
            $users = $this->model->getList();
            return view('user.users', [
                'title' => "Список пользователей",
                'users' => $users
            ]);
        } else {
            return view('user.update', [
                'title' => "Изменить данные пользователя",
                'request' => $res
            ]);
        }
    }

    public function userUpdatePass(Request $request) {
        $res = $this->model->updatePass($request);

        if(is_int($res)) {
            $users = $this->model->getList();
            return view('user.users', [
                'title' => "Список пользователей",
                'users' => $users
            ]);
        } else {
            return view('user.update_pass', [
                'title' => "Изменить данные пользователя",
                'request' => $res
            ]);
        }
    }

    public function userDelete() {
        $this->model->deleteUser();
            return view('main', [
                'title' => "Главная",
            ]);
    }



}
