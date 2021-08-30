<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Support\Facades\DB;

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

    public $id;
    public $name;
    public $surname;
    public $email;
    public $phone;
    public $address;

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
        $users = DB::table('users')
            ->select('id', 'name', 'last_name', 'email', 'phone', 'address', 'password', 'remember_token')
            ->get();

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
                'password' => $request->password,
                'remember_token' => $request->_token,
                'created_at' => $date,
                'updated_at' => $date,
            ]);
            } else {
                $req = "Пользователь с E-mail " . $request->email . " уже сущесвует!";
            }
        } else {
            $req = "Пароли не совпадают";
        }

        return $req;
    }

    public function updateInfo($request) {/*Ss1Ss1_21*/

        $request->validate([
            'name' => 'required|string',
            'last_name' => 'required|string',
            'email' => 'required|email',
            'phone' => 'required|regex:/^\+[0-9]{11}$/',
            'address' => 'required|string',

        ]);$req = $request->all();
        var_dump($req);
            if ($this->userExist($request->email)) {
                $email_verified_at = date("Y-m-d H:i:s");
                $date = date("Y-m-d H:i:s");

                $req = "zbs";
                /*$req = DB::table('users')->update([
                    'name' => $request->name,
                    'last_name' => $request->last_name,
                    'email' => $request->email,
                    'email_verified_at' =>$email_verified_at,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'remember_token' => $request->_token,
                    'updated_at' => $date,
                ]);*/
            } else {
                $req = "Пользователя с E-mail " . $request->email . " не сущесвует!";
            }


        return $req;
    }
}
