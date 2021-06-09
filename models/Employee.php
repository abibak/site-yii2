<?php

namespace app\models;

use yii\db\ActiveRecord;

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
 */
class Employee extends ActiveRecord
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
            [['position_id'], 'exist', 'skipOnError' => true, 'targetClass' => Positions::class, 'targetAttribute' => ['position_id' => 'id']],
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
     * Gets query for [[FullName]].
     *
     * @return string
     */
    public function getFullName()
    {
        return $this->name . ' ' . $this->surname . ' ' . $this->patronymic;
    }
}
