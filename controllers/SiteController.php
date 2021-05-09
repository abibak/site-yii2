<?php

namespace app\controllers;

use app\models\Services;
use Yii;
use yii\db\Query;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Product;
use app\models\Employee;
use app\models\Records;
use app\models\Clients;

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

        if ($request->isAjax && $request->get('id') !== null) {
            $id_employee = $request->get('id'); // ajax запрос

            $data_records = Records::find()->select('time')->where(['hairdresser_id' => $id_employee])->all();

            $employee_schedule = array();

            $listTimes = array();

            foreach ($data_records as $index => $value) {
                $listTimes[] = $data_records[$index]['time'];
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

        if ($request->isAjax) {
            $data_record = (array)json_decode($request->get('record'));

            for ($i = 0; $i < count($data_record['serviceId']); ++$i) {
                Yii::$app->db->createCommand()->insert('records', [
                    'client_id' => $data_record['clientId'],
                    'hairdresser_id' => $data_record['hairdresserId'],
                    'service_id' => $data_record['serviceId'][$i],
                    'date' => $data_record['date'],
                    'time' => $data_record['time'],
                ])->execute();
            }
            die();
        }

        $data_employees = Employee::find()->select('id, name, surname')->all();
        $query = new yii\db\Query();
        $data_services = $query->from(['e' => 'service_tariffs'])
            ->join('INNER JOIN', 'services', 'e.service_id = services.id')->all();

        return $this->render('index', ['employees' => $data_employees, 'services' => $data_services]);
    }

    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
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

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionProducts()
    {
        $query = Product::find()->all();
        return $this->render('products', ['products' => $query]);
    }

    public function actionService()
    {
        $query = new Query();
        $services = $query->from(['e' => 'service_tariffs'])
            ->join('INNER JOIN', 'services', 'e.service_id = services.id')->all();

        return $this->render('service', ['services' => $services]);
    }

    /**
     * @throws \yii\base\Exception
     */
    public function actionRegister()
    {
        $request = Yii::$app->request;
        $model = new Clients();

        if (!Yii::$app->user->isGuest) {
            $this->redirect('/');
        }

        if ($model->load($request->post()) && $model->validate()) {
            $user = new User();

            $user->name = $model->name;
            $user->surname = $model->surname;
            $user->patronymic = $model->patronymic;
            $user->phone = $model->phone;
            $user->password = Yii::$app->security->generatePasswordHash($model->password);

            if ($user->save()) {
                return $this->goHome();
            }

            die();
        }

        return $this->render('register', ['model' => $model]);
    }
}







