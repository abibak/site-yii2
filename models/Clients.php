<?php

namespace app\models;

use yii\base\Model;

class Clients extends Model
{
    public $name;
    public $surname;
    public $patronymic;
    public $phone;
    public $password;

    public function rules()
    {
        return [
            [['name', 'surname', 'patronymic', 'password'], 'required'],
            ['phone', 'unique', 'targetClass' => 'app\models\User', 'message' => 'Этот номер телефона уже используется'],
            ['name', 'string', 'min' => 2, 'max' => 150],
            ['surname', 'string', 'min' => 2, 'max' => 200],
            ['patronymic', 'string', 'min' => 2, 'max' => 250],
        ];
    }

    public function attributeLabels()
    {
        return [
            'name' => 'Имя пользователя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'phone' => 'Телефон',
            'password' => 'Пароль'
        ];
    }
}
