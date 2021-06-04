<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "services".
 *
 * @property int $id
 * @property int $category_id
 * @property string $name
 * @property string $work_time
 *
 * @property Records[] $records
 * @property ServiceTariffs[] $serviceTariffs
 * @property Categories $category
 */
class Services extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'services';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['category_id', 'name', 'work_time'], 'required'],
            [['category_id'], 'integer'],
            [['name'], 'string', 'max' => 150],
            [['work_time'], 'string', 'max' => 50],
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
            'category_id' => 'Категория',
            'name' => 'Название',
            'work_time' => 'Время выполнения',
        ];
    }

    /**
     * Gets query for [[Records]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRecords()
    {
        return $this->hasMany(Records::className(), ['service_id' => 'id']);
    }

    /**
     * Gets query for [[ServiceTariffs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getServiceTariffs()
    {
        return $this->hasMany(ServiceTariffs::className(), ['service_id' => 'id']);
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
