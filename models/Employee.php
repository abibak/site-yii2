<?php

namespace app\models;

use app\models\Positions;

/**
 * This is the model class for table "employees".
 *
 * @property int $id
 * @property int $position_id
 * @property string $name
 * @property string $surname
 * @property string $patronymic
 * @property int $age
 * @property int $phone
 * @property string $email
 * @property float $salary
 * @property int $status
 * @property string $password
 *
 * @property Positions $position
 * @property Records[] $records
// * @property Schedule[] $schedules
 */
class Employee extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'employees';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['position_id', 'name', 'surname', 'patronymic', 'age', 'phone', 'email', 'salary', 'status'], 'required'],
            [['position_id', 'age', 'phone', 'status'], 'integer'],
            [['salary'], 'number'],
            [['name'], 'string', 'max' => 150],
            [['surname'], 'string', 'max' => 200],
            [['patronymic'], 'string', 'max' => 250],
            [['email'], 'string', 'max' => 30],
            [['phone'], 'unique'],
            [['email'], 'unique'],
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => Positions::className(), 'targetAttribute' => ['position_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'position_id' => 'Позиция',
            'name' => 'Имя',
            'surname' => 'Фамилия',
            'patronymic' => 'Отчество',
            'age' => 'Возраст',
            'phone' => 'Телефон',
            'email' => 'Email',
            'salary' => 'Зарплата',
            'status' => 'Статус',
        ];
    }
}
