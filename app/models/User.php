<?php


namespace app\models;


class User extends AppModel
{
        public $attributes = [
            'login' => null,
            'password' => null,
            'name' => '',
            'number' => '',
            'email' => '',
            'address_street' => '',
            'address_home' => '',
            'address_porch' => '',
            'address_floor' => '',
            'address_apartment' => '',
            'role' => 'user',
        ];

        public $rules = [
            'required' => [
                ['name'],
                ['number'],
                ['email'],
            ],

            'email' => [
                ['email'],
            ],

            'numeric' => [
                ['number'],
            ],

            'lengthMax' => [
                ['number', 12],
            ],

        ];

        public function checkUnique()
        {
            $user = \R::findOne('user', 'email = ? OR number = ?',
                [$this->attributes['email'], $this->attributes['number']]);
            if ($user){
                if ($user->email == $this->attributes['email']){
                    $this->errors['unique'][] = 'Этот email уже занят';
                }
                if ($user->number == $this->attributes['number']){
                    $this->errors['unique'][] = 'Этот телефон уже занят';
                }
                return false;
            }
            return true;
        }

        public function login($isAdmin = false,$isManager = false)
        {
            $login = !empty(trim($_POST['login'])) ? trim($_POST['login']) : null;
            $password = !empty(trim($_POST['password'])) ? trim($_POST['password']) : null;
            if ($login && $password){
                if ($isAdmin){
                    $user = \R::findOne('user',"login = ? AND role = 'admin'", [$login]);
                }elseif ($isManager){
                    $user = \R::findOne('user',"login = ? AND role = 'manager'", [$login]);
                }
                else {
                    $user = \R::findOne('user',"login = ?", [$login]);
                }
                if ($user){
                    if (password_verify($password, $user->password)){
                        foreach ($user as $k => $v){
                            if ($k != 'password') $_SESSION['user'][$k] = $v;
                        }
                        return true;
                    }
                }
            }
            return false;
        }

        public static function checkAuth()
        {
            return isset($_SESSION['user']);
        }

        public static function isAdmin()
        {
            return (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'admin');
        }

        public static function isManager()
        {
            return (isset($_SESSION['user']) && $_SESSION['user']['role'] == 'manager');
        }

}