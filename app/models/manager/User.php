<?php


namespace app\models\manager;


class User extends \app\models\User
{
        public $attributes = [
            'id' => '',
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
            'role' => '',
        ];

        public $rules = [
            'required' => [
                ['name'],
                ['number'],
                ['email'],
                ['login'],
                ['role'],
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
            $user = \R::findOne('user', '(login = ? OR email = ? OR number = ?) AND id <> ?',
                [$this->attributes['login'], $this->attributes['email'], $this->attributes['number'], $this->attributes['id']]);
            if ($user){
                if ($user->login == $this->attributes['login']){
                    $this->errors['unique'][] = 'Этот логин уже занят';
                }
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
}