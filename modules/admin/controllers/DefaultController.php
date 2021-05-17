<?php

namespace app\modules\admin\controllers;

use app\models\Employee;
use app\models\User;
use Yii;
use yii\web\Controller;

/**
 * Default controller for the `admin` module
 */
class DefaultController extends Controller
{
    public function actionIndex()
    {
        $user = new User();

        if (Yii::$app->user->isGuest || (int)$user->getPosition()['position'] !== 1) {
            return $this->redirect('/');
        }

        return $this->render('index');
    }
}
