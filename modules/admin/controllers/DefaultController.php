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
                'count_users' => [
                    'name' => 'Количество пользователей',
                    'value' => Users::find()->select('id')->count('id')
                ],

                'count_employees' => [
                    'name' => 'Количество сотрудников',
                    'value' => Employee::find()->select('id')->count('id')
                ],

                'count_records' => [
                    'name' => 'Количество записей',
                    'value' => Records::find()->select('id')->count('id')
                ],

                'count_orders' => [
                    'name' => 'Количество заказов',
                    'value' => Orders::find()->select('id')->count('id')
                ],
            ],
        ]);
    }
}
