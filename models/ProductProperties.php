<?php

namespace app\models;

use Yii;
use yii\base\BaseObject;
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
class ProductProperties extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product_properties';
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
