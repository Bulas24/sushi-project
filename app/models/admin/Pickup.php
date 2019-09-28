<?php


namespace app\models\admin;


use app\models\AppModel;

class Pickup extends AppModel
{
    public $attributes = [
        'title' => '',
    ];

    public $rules = [
        'required' => [
            ['title'],
        ],
    ];
}