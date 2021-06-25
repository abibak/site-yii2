<?php

namespace app\modules\admin;

use app\models\User;
use Yii;

/**
 * admin module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * {@inheritdoc}
     */
    public $controllerNamespace = 'app\modules\admin\controllers';

    /**
     * {@inheritdoc}
     */
    public function init()
    {
        //  ВРЕМЕННО ЗАКОММЕНТИРОВАННО, "доступ в админку"!!!11!

        // if (!User::getPosition()) {
        //     return Yii::$app->response->redirect('/');
        // }

        parent::init();

        $this->layout = 'basic';
    }
}
