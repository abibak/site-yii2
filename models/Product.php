<?php
namespace app\models;

use yii\db\ActiveRecord;

class Product extends ActiveRecord
{
    static public function tableName()
    {
        return 'products';
    }
}
