<?php

namespace app\models;

use Yii;
use Yii\db\ActiveRecord;

/**
 * This is the model class for table "orders".
 *
 * @property int $id
 * @property int $user_id
 * @property int $product_id
 * @property int $quantity_product
 * @property string $order_time
 * @property int $amount
 * @property string $payment
 *
 * @property Products $product
 * @property Users $user
 */
class Orders extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'product_id', 'quantity_product', 'order_time', 'amount', 'payment'], 'required'],
            [['user_id', 'product_id', 'quantity_product', 'amount'], 'integer'],
            [['order_time'], 'safe'],
            [['payment'], 'string', 'max' => 50],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'product_id' => 'Product ID',
            'quantity_product' => 'Quantity Product',
            'order_time' => 'Order Time',
            'amount' => 'Amount',
            'payment' => 'Payment',
        ];
    }
}
