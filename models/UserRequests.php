<?php

namespace app\models;

use Yii;
use Yii\db\ActiveRecord;
/**
 * This is the model class for table "user_requests".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $subject
 * @property string $body
 */
class UserRequests extends ActiveRecord
{
    public $verifyCode;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'user_requests';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'email', 'subject', 'body'], 'required'],
            [['name', 'subject'], 'string', 'max' => 150],
            [['email'], 'string', 'max' => 100],
            [['body'], 'string', 'max' => 500],
            [['verifyCode'], 'captcha'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'name' => 'Имя',
            'email' => 'Почта',
            'subject' => 'Тема',
            'body' => 'Описание',
            'verifyCode' => 'Проверяющий код',
        ];
    }
}
