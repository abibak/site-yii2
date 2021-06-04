<?php

namespace app\controllers;

use app\models\UserRequests;
use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Products;
use app\models\Records;
use app\models\Users;
use yii\widgets\ActiveForm;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     * @throws \yii\db\Exception
     */
    public function actionIndex()
    {
        $request = Yii::$app->request;

        if ($request->isAjax && /*$request->get('id') !== null || */$request->post('data')) {
            $post_time = (array)json_decode($request->post('data'));

            // получение времени
            $data_records = Records::find()->select('date, time')->where(['hairdresser_id' => $post_time['hairdresserId'], 'date' => $post_time['time']])->all();


            $employee_schedule = array();
            $listTimes = array();

            foreach ($data_records as $index => $value) {
                $listTimes[] = $data_records[$index]['time']; // all times
            }

            for ($i = 9; $i < 21; ++$i) {
                $currentTime = $i . ':00';

                if (!in_array($currentTime, $listTimes)) {
                    $employee_schedule[] = $i . ':00';
                }
            }

            echo json_encode($employee_schedule);
            die();
        }

        if ($request->isAjax && $request->post('record') !== null) {
            $data_record = (array)json_decode($request->post('record'));

            for ($i = 0; $i < count($data_record['serviceId']); ++$i) {
                Yii::$app->db->createCommand()->insert('records', [
                    'client_id' => Yii::$app->user->getId(),
                    'hairdresser_id' => $data_record['hairdresserId'],
                    'service_id' => $data_record['serviceId'][$i],
                    'date' => $data_record['date'],
                    'time' => $data_record['time'],
                ])->execute();
            }
            die();
        }
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        $request = Yii::$app->request;

        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load($request->post()) && $request->isAjax) {
            $dataFormLogin = $request->post('LoginForm');

            $model->phone = $dataFormLogin['phone'];
            $model->password = $dataFormLogin['password'];

            if ($model->login()) {
                return $this->redirect('/');
            }

            die();
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }


    public function actionContact()
    {
        $request = Yii::$app->request;

        $model = new UserRequests();

        if ($model->load($request->post())) {
            $model->save();
            die();
        }

        return $this->render('contact_admin', ['model' => $model]);
    }


//    /**
//     * Displays contact page.
//     *
//     * @return Response|string
//     */
//    public function actionContact()
//    {
//        $model = new ContactForm();
//
//        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
//            Yii::$app->session->setFlash('contactFormSubmitted');
//
//            return $this->refresh();
//        }
//        return $this->render('contact', [
//            'model' => $model,
//        ]);
//    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    /**
     * @throws \yii\db\Exception
     */
    public function actionProducts()
    {
        $request = Yii::$app->request;

        if ($request->isAjax) {
            $order_time = date('Y-m-d H:i:s');

            $received_data = $request->post();

            foreach ($received_data['products'] as $product) {
                Yii::$app->db->createCommand()->insert('orders', [
                    'user_id' => Yii::$app->user->getId(),
                    'product_id' => $product['id'],
                    'quantity_product' => $product['count'],
                    'order_time' => $order_time,
                    'amount' => $product['amount'],
                    'payment' => $received_data['payment'],
                ])->execute();
            }
            die();
        }

        $query = Products::find()->all();
        return $this->render('products', ['products' => $query]);
    }

    public function actionService()
    {
        $query = new Query();
        $services = $query->from(['st' => 'service_tariffs'])
            ->join('INNER JOIN', 'services', 'st.service_id = services.id')->all();

        return $this->render('service', ['services' => $services]);
    }

    /**
     * @throws \yii\base\Exception
     */
    public function actionRegister()
    {
        $request = Yii::$app->request;
        $model = new Users();

        if (!Yii::$app->user->isGuest) {
            $this->redirect('/');
        }

        if ($request->isAjax && $model->load($request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load($request->post())) {
            if ($model->validate()) {
                $user = new User();

                $user->position_id = 4;
                $user->name = $model->name;
                $user->surname = $model->surname;
                $user->patronymic = $model->patronymic;
                $user->phone = $model->phone;
                $user->password = Yii::$app->security->generatePasswordHash($model->password);

                if ($user->save()) {
                    return $this->redirect('/site/login');
                }
            }
            die();
        }

        return $this->render('register', ['model' => $model]);
    }

    public function actionProfile()
    {

    }
}







