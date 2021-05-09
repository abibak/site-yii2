<?php

namespace app\models;

use yii\db\ActiveRecord;

class Employee extends ActiveRecord
{
    static public function tableName()
    {
        return 'employees';
    }
}
