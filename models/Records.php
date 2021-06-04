<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "records".
 *
 * @property int $id
 * @property int $client_id
 * @property int $hairdresser_id
 * @property int|null $service_id
 * @property string $date
 * @property string $time
 *
 * @property Users $client
 * @property Employee $hairdresser
 * @property Services $service
 */
class Records extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'records';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'hairdresser_id', 'date', 'time'], 'required'],
            [['client_id', 'hairdresser_id', 'service_id'], 'integer'],
            [['date'], 'safe'],
            [['time'], 'string', 'max' => 6],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['client_id' => 'id']],
            [['hairdresser_id'], 'exist', 'skipOnError' => true, 'targetClass' => Employee::className(), 'targetAttribute' => ['hairdresser_id' => 'id']],
            [['service_id'], 'exist', 'skipOnError' => true, 'targetClass' => Services::className(), 'targetAttribute' => ['service_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Client ID',
            'hairdresser_id' => 'Hairdresser ID',
            'service_id' => 'Service ID',
            'date' => 'Date',
            'time' => 'Time',
        ];
    }

    /**
     * Gets query for [[Client]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Users::className(), ['id' => 'client_id']);
    }

    /**
     * Gets query for [[Hairdresser]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHairdresser()
    {
        return $this->hasOne(Employee::className(), ['id' => 'hairdresser_id']);
    }

    /**
     * Gets query for [[Service]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Services::className(), ['id' => 'service_id']);
    }
}
