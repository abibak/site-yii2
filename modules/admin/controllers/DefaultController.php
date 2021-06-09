<?php

namespace app\modules\admin\controllers;

use app\models\Employee;
use app\models\Orders;
use app\models\Records;
use app\models\Users;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    /**
     * @throws \yii\db\Exception
     */
    public function actionIndex()
    {
        return $this->render('index', [
            'data' => [
                'Количество пользователей' => [
                    'value' => Users::find()->select('id')->count('id')
                ],

                'Количество сотрудников' => [
                    'value' => Employee::find()->select('id')->count('id')
                ],

                'Количество записей' => [
                    'value' => Records::find()->select('id')->count('id')
                ],

                'Количество заказов' => [
                    'value' => Orders::find()->select('id')->count('id')
                ],
            ],
        ]);
    }
}
