<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\User;
use yii\helpers\Url;
use app\models\LoginForm;
use app\models\ForgotForm;

class UserController extends Controller
{
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                // 'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionSignup()
    {
        $user = new User(['scenario' => User::SCENARIO_SIGNUP]);

        // Если пришли данные для сохранения
        if(isset($_POST['User']))
        {
            // Безопасное присваивание значений атрибутам
            $user->attributes = $_POST['User'];

            //vd($user, true);

            // Проверка данных
            if($user->validate())
            {
                // Сохранить полученные данные
                // false нужен для того, чтобы не производить повторную проверку
                $user->save(false);
                // Перенаправить на список зарегестрированных пользователей
                $this->redirect(Url::toRoute('user/'));
            }
        }

        return $this->render('signup', ['model' => $user]);
    }
/*
    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            // vd(Yii::$app->getUser()->getIdentity());

            return $this->goBack();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
*/

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            // return $this->goBack();
            $this->goHome();
        } else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionForgotPassword()
    {
        $postData = Yii::$app->request->post();
        $model = new ForgotForm();

        if ( $model->load($postData) && $model->validate() )
        {
            $User = User::findOne(['email' => $model->username]);

            if ( !empty($User) )
            {
                $User->activation_link = User::generateHash();
                $User->save();

                // var_dump(Yii::$app->mailer->viewPath); die();
                Yii::$app->mailer->viewPath = '@app/views';
                Yii::$app->mailer->compose('email/user-remind-password', ['User' => $User])
                    ->setFrom(Yii::$app->params['fromEmail'])
                    ->setTo($User->email)
                    ->setSubject(Yii::t('user', 'Recover Password') . Yii::$app->params['siteName'])
                    ->send();

                return $this->render('forgot-password-sent', ['User' => $User]);
            }
            /*
            else
            {
                $error = Yii::t('user', 'User with this Email not exist.');
            }
            */
        }

        return $this->render('forgot-password', ['User' => $User, 'model' => $model]);
    }

    public function actionRecoverPassword($link)
    {

    }
}
