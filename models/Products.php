<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "products".
 *
 * @property int $id
 * @property int|null $category_id
 * @property int|null $discount_id
 * @property string $name
 * @property string $description
 * @property float $price
 * @property string $image
 *
 * @property Orders[] $orders
 * @property ProductProperties[] $productProperties
 * @property Discounts $discount
 * @property Categories $category
 */
class Products extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'products';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'discount_id'], 'integer'],
            [['name', 'description', 'price', 'image'], 'required'],
            [['price'], 'number'],
            [['name'], 'string', 'max' => 150],
            [['description'], 'string', 'max' => 500],
            [['image'], 'string', 'max' => 100],
            [['discount_id'], 'exist', 'skipOnError' => true, 'targetClass' => Discounts::className(), 'targetAttribute' => ['discount_id' => 'id']],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Categories::className(), 'targetAttribute' => ['category_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'category_id' => 'Category ID',
            'discount_id' => 'Discount ID',
            'name' => 'Name',
            'description' => 'Description',
            'price' => 'Price',
            'image' => 'Image',
        ];
    }

    /**
     * Gets query for [[Orders]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getOrders()
    {
        return $this->hasMany(Orders::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[ProductProperties]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProductProperties()
    {
        return $this->hasMany(ProductProperties::className(), ['product_id' => 'id']);
    }

    /**
     * Gets query for [[Discount]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDiscount()
    {
        return $this->hasOne(Discounts::className(), ['id' => 'discount_id']);
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Categories::className(), ['id' => 'category_id']);
    }
}
