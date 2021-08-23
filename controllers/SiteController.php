<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;

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
                    'logout' => ['post'],
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
     */
    public function actionIndex()
    {
        return $this->render('index');
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

    public function actionCto()
    {
        return $this->render('cto');
    }

    public function actionSiteOptimizationSeo()
    {
        return $this->render('site-optimization-seo');
    }

    public function actionProgrammingAndDevelopment()
    {
        return $this->render('programming-and-development');
    }

    public function actionTesting()
    {
        return $this->render('testing');
    }

    public function actionTechnicalWriter()
    {
        return $this->render('technical-writer');
    }

    public function actionProjectManagement()
    {
        return $this->render('project-management');
    }

    public function actionAnalyst()
    {
        return $this->render('analyst');
    }

    public function actionDentist()
    {
        return $this->render('dentist');
    }

    public function actionPediatrician()
    {
        return $this->render('pediatrician');
    }

    public function actionCopywriter()
    {
        return $this->render('copywriter');
    }

    public function actionAccountant()
    {
        return $this->render('accountant');
    }

    public function actionLawyer()
    {
        return $this->render('lawyer');
    }

    public function actionCourier()
    {
        return $this->render('courier');
    }

    public function actionSecurity()
    {
        return $this->render('security');
    }

    public function actionTrainer()
    {
        return $this->render('trainer');
    }

    public function actionWaiter()
    {
        return $this->render('waiter');
    }

    public function actionPsychologist()
    {
        return $this->render('psychologist');
    }

    public function actionBiotechnologist()
    {
        return $this->render('biotechnologist');
    }

    public function actionRoboticist()
    {
        return $this->render('roboticist');
    }

    public function actionMarketer()
    {
        return $this->render('marketer');
    }

    public function actionDesigner()
    {
        return $this->render('designer');
    }

    public function actionGeneticist()
    {
        return $this->render('geneticist');
    }

    public function actionInformationSecurity()
    {
        return $this->render('information-security');
    }

    public function actionTeacher()
    {
        return $this->render('teacher');
    }

    public function actionDataEngineer()
    {
        return $this->render('data-engineer');
    }

    public function actionDataScientist()
    {
        return $this->render('data-scientist');
    }

    public function actionDyingProfessions()
    {
        return $this->render('dying-professions');
    }
}
