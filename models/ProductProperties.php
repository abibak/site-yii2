<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\db\Query;

/**
 * This is the model class for table "product_properties".
 *
 * @property int $id
 * @property int $product_id
 * @property int $volume
 * @property float $price
 * @property int $amount
 *
 * @property Products $product
 */
class ProductProperties extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_properties';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['product_id', 'volume', 'amount'], 'required'],
            [['product_id', 'volume', 'amount'], 'integer'],
            [['product_id'], 'exist', 'skipOnError' => true, 'targetClass' => Products::className(), 'targetAttribute' => ['product_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'ID товара',
            'volume' => 'Объем',
            'amount' => 'Количество',
        ];
    }

    /**
     * Gets query for [[Product]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductName()
    {
        return $this->hasOne(Products::className(), ['id' => 'product_id']);
    }

    /**
     * Gets query for [[Product]].
     *
     * @return array|bool
     */
    public function getProduct()
    {
        $query = new Query();
        return $query->from(['p' => 'products'])
            ->join('INNER JOIN', 'product_properties', 'p.id = product_properties.product_id')->all();
    }
}
