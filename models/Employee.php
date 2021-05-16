<?php

namespace app\models;

use Yii;

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
 * @property Schedule[] $schedules
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
            [['position_id', 'name', 'surname', 'patronymic', 'age', 'phone', 'email', 'salary', 'status', 'password'], 'required'],
            [['position_id', 'age', 'phone', 'status'], 'integer'],
            [['salary'], 'number'],
            [['name'], 'string', 'max' => 150],
            [['surname'], 'string', 'max' => 200],
            [['patronymic'], 'string', 'max' => 250],
            [['email'], 'string', 'max' => 30],
            [['password'], 'string', 'max' => 60],
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
            'position_id' => 'Position ID',
            'name' => 'Name',
            'surname' => 'Surname',
            'patronymic' => 'Patronymic',
            'age' => 'Age',
            'phone' => 'Phone',
            'email' => 'Email',
            'salary' => 'Salary',
            'status' => 'Status',
            'password' => 'Password',
        ];
    }

    /**
     * Gets query for [[Position]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPosition()
    {
        return $this->hasOne(Positions::className(), ['id' => 'position_id']);
    }

    /**
     * Gets query for [[Records]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRecords()
    {
        return $this->hasMany(Records::className(), ['hairdresser_id' => 'id']);
    }

    /**
     * Gets query for [[Schedules]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSchedules()
    {
        return $this->hasMany(Schedule::className(), ['employees_id' => 'id']);
    }
}
