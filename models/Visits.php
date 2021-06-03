<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "visits".
 *
 * @property int $id
 * @property int $client_id
 * @property string $date_visit
 * @property float $payment_amount
 *
 * @property Users $client
 */
class Visits extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'visits';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['client_id', 'date_visit', 'payment_amount'], 'required'],
            [['client_id'], 'integer'],
            [['date_visit'], 'safe'],
            [['payment_amount'], 'number'],
            [['client_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['client_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'client_id' => 'Клиент',
            'date_visit' => 'Дата визита',
            'payment_amount' => 'Сумма оплаты',
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
}
