<?php

namespace App\Models;

use App\Http\Controllers\LoginController;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function getUser($field, $value)
    {
        $user = DB::table('users')
            ->select('id', 'name', 'last_name', 'email', 'phone', 'address', 'password', 'remember_token')
            ->where($field, '=', $value)
            ->get();
        return $user;
    }

    public function getList()
    {
        /*$users = DB::table('users')
            ->select('id', 'name', 'last_name', 'email', 'phone', 'address', 'password', 'remember_token')
            ->get();*/
        $users = DB::table('users')->paginate(2);
        return $users;
    }

    public function userExist($email) {
        $user = $this->getUser('email', $email);
        if($user->isEmpty()) {
            return false;
        }else {
            return true;
        }
    }
    public function authorizationUser($request) {
        $request->validate([
            'login' => 'required|email',
            'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d][^\s]{8,}$/',
        ]);
        $user = DB::table('users')
            ->select('id', 'email', 'password', 'remember_token')
            ->where('email', '=', $request->login)
            ->get();
        if(!$user->isEmpty()) {
            $user = $user[0];
            if (Hash::check($request->password, $user->password)) {
                $req = LoginController::login($user->id);
            } else {
                $req = "Неверный пароль!";
            }
        }
        else {
            $req = "Введите логин правильно";
        }
        return $req;
    }

    public function add($request)
    {/*Ss1Ss1_21*/
        $request->validate([
            'name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|regex:/^\+[0-9]{11}$/',
            'address' => 'required|string',
            'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d][^\s]{8,}$/',
            'repeat_password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d][^\s]{8,}$/',
        ]);
        if ($request->password == $request->repeat_password) {
            $email_verified_at = date("Y-m-d H:i:s");
            $date = date("Y-m-d H:i:s");
            if (!$this->userExist($request->email)) {
                $req = DB::table('users')->insert([
                    'name' => $request->name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'email_verified_at' =>$email_verified_at,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'password' => Hash::make($request->password),
                    'remember_token' => $request->_token,
                    'created_at' => $date,
                    'updated_at' => $date,
                ]);
                $user = $this->getUser('email', $request->email);
                LoginController::login($user[0]->id);
            } else {
                $req = "Пользователь с E-mail " . $request->email . " уже сущесвует!";
            }
        } else {
            $req = "Пароли не совпадают";
        }

        return $req;
    }

    public function updateInfo($request) {

        $request->validate([
            'name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|regex:/^\+[0-9]{11}$/',
            'address' => 'required|string',

        ]);
            $email_verified_at = date("Y-m-d H:i:s");
            $date = date("Y-m-d H:i:s");
            $user = Auth::user();
            $req = DB::table('users')->where('id', "=" , $user->id)->update([
                'name' => $request->name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'email_verified_at' =>$email_verified_at,
                'phone' => $request->phone,
                'address' => $request->address,
                'remember_token' => $request->_token,
                'updated_at' => $date,
            ]);



        return $req;
    }

    public function updatePass($request) {/*Ss1Ss1_21*/

        $request->validate([
            'old_password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d][^\s]{8,}$/',
            'password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d][^\s]{8,}$/',
            'repeat_password' => 'required|regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)[a-zA-Z\d][^\s]{8,}$/',

        ]);
        $user = Auth::user();
        if (Hash::check($request->old_password, $user->password)) {
        if ($request->password == $request->repeat_password) {
            $date = date("Y-m-d H:i:s");
            $req = DB::table('users')->where('id', "=" , $user->id)->update([
                'password' => Hash::make($request->password),
                'updated_at' => $date,
            ]);
        } else {
        $req = "Пароли не совпадают!";
    }
        } else {
            $req = "Старый пароль не верен!";
        }
        return $req;
    }

    public function deleteUser() {
        $user = Auth::user();
        DB::table('users')->where('id', '=', $user->id)->delete();
        LoginController::logout();
    }


}
