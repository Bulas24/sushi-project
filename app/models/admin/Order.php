<?php


namespace app\models\admin;


class Order extends \app\models\Order
{
    public $attributes = [
        'name' => '',
        'number' => '',
        'email' => '',
        'how_delivery' => '',
        'time_add' => '',
        'time' => '',
        'pickup_address_id' => '',
        'delivery' => '',
        'change_money' => '',
        'note_man' => '',
        'address_street' => '',
        'address_home' => '',
        'address_porch' => '',
        'address_floor' => '',
        'address_apartment' => '',
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
}