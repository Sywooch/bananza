<?php

namespace app\controllers;

use app\models\PaymentSystemToUser;
use app\models\PaymentSystem;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use app\models\TransactionWm;
use app\models\Transaction;
use app\models\User;

class PaymentController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                // 'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['index', 'success', 'fail'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['stat'],
                        'allow' => true,
                        'roles' => ['?', '@'],
                    ],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }

    public function beforeAction($action)
    {
        if ( in_array($action, ['success', 'fail', 'stat']) )
        {
            $this->enableCsrfValidation = FALSE;
        }

        return parent::beforeAction($action);
    }



    public function actionIndex()
    {

    /*)

        ["LMI_PAYMENT_NO"]=&gt;
        string(1) "0"
    ["LMI_SYS_INVS_NO"]=&gt;
  string(3) "371"
    ["LMI_SYS_TRANS_NO"]=&gt;
  string(3) "699"
    ["LMI_SYS_TRANS_DATE"]=&gt;
  string(17) "20150706 15:11:10"
    ["LMI_LANG"]=&gt;
  string(5) "ru-RU"
        die();
        // http://bananza.cyborg.su/payment/success/?LMI_PAYMENT_NO=0&LMI_SYS_INVS_NO=62&LMI_SYS_TRANS_NO=921&LMI_SYS_TRANS_DATE=20150706+12%3A09%3A54&LMI_LANG=ru-RU
        LMI_PAYEE_PURSE
        R101111803389
        // Дата и время реального прохождения платежа в системе WebMoney Transfer в формате "YYYYMMDD HH:MM:SS".
        LMI_SYS_TRANS_DATE


    LMI_SYS_INVS_NO

    LMI_SYS_TRANS_NO


*/
        return $this->render('index');
    }

    public function actionSuccess()
    {
        $postDataAr = Yii::$app->request->post();

        if ( !empty($postDataAr) )
        {
            $TransactionWm = TransactionWm::findOne([
                'LMI_SYS_INVS_NO' => $postDataAr ['LMI_SYS_INVS_NO'],
                'LMI_SYS_TRANS_NO' => $postDataAr ['LMI_SYS_TRANS_NO'],
                'LMI_SYS_TRANS_DATE' => $postDataAr ['LMI_SYS_TRANS_DATE'],
                'status' => TransactionWm::STATUS_ADDED,
            ]);

            if ( !empty($TransactionWm) )
            {
                $user_id = Yii::$app->getUser()->getId();
                $PaymentSystemToUser = PaymentSystemToUser::findOne([
                    'user_id' => $user_id,
                    'value' => $TransactionWm->LMI_PAYER_PURSE
                ]);

                if ( empty($PaymentSystemToUser) )
                {
                    switch ( substr($TransactionWm->LMI_PAYER_PURSE, 0, 1) )
                    {
                        case 'R':
                            $PaymentSystem = PaymentSystem::findOne(['short_name' => 'WMR']);

                            $PaymentSystemToUser = new PaymentSystemToUser;
                            $PaymentSystemToUser->user_id = $user_id;
                            $PaymentSystemToUser->payment_system_id = $PaymentSystem->id;
                            $PaymentSystemToUser->value = $TransactionWm->LMI_PAYER_PURSE;
                            $PaymentSystemToUser->save();

                            $amount = $TransactionWm->LMI_PAYMENT_AMOUNT;
                        break;
                    }
                }
                else
                {
                    switch ( substr($PaymentSystemToUser->value, 0, 1) )
                    {
                        case 'R':
                            $amount = $TransactionWm->LMI_PAYMENT_AMOUNT;
                        break;
                    }
                }

                $Transaction = new Transaction;
                $Transaction->user_id = $user_id;
                $Transaction->payment_system_to_user_id = $PaymentSystemToUser->id;
                $Transaction->amount = $amount;
                $Transaction->status = $Transaction::STATUS_ADDED;
                $Transaction->type = $Transaction::TYPE_INCOME_COMPLETED;
                if ( $Transaction->save() )
                {
                    $User = User::findOne($user_id);
                    // var_dump($User->getScenario());
                    // die();

                    // $User->setScenario(User::SCENARIO_SUCCESS);
                    $User->balance += $amount;

                    $User->save();

                    $TransactionWm->status = TransactionWm::STATUS_COMPLETED;
                    $TransactionWm->save();
                    // var_dump($User->getErrors());
                    // die();
                }
            }
        }


        return $this->render('success');
    }

    public function actionFail()
    {
        return $this->render('fail');
    }

    public function actionStat()
    {
        /*
                $testData = [
                    "LMI_MODE" => "1",
                    "LMI_PAYMENT_AMOUNT" => "70.00",
                    "LMI_PAYEE_PURSE" => "R101111803389",
                    "LMI_PAYMENT_NO" =>  "0",
                    "LMI_PAYER_WM" => "261613619335",
                    "LMI_PAYER_PURSE" => "R101111803389",
                    "LMI_PAYER_COUNTRYID" => "UA",
                    "LMI_PAYER_PCOUNTRYID" => "UA",
                    "LMI_PAYER_IP" => "178.94.95.100",
                    "LMI_SYS_INVS_NO" => "192",
                    "LMI_SYS_TRANS_NO" => "984",
                    "LMI_SYS_TRANS_DATE" => "20150707 12:52:15",
                    "LMI_HASH" => "55C47770185EC6276C3946723355199F2339862EBEA6C3075526585B01202599",
                    "LMI_PAYMENT_DESC" => 'Оплата за услуги',
                    "LMI_LANG" => "ru-RU",
                    "LMI_DBLCHK" => "SMS",
                ];




                $postDataAr = Yii::$app->request->post();
                $postDataAr ['LMI_PAYMENT_DESC'] = mb_convert_encoding($postDataAr ['LMI_PAYMENT_DESC'], 'utf-8', mb_detect_encoding($postDataAr ['LMI_PAYMENT_DESC']));

                Yii::$app->db->createCommand()->insert('transaction_wm', [
                    'description' => base64_encode(serialize($postDataAr)),
                ])->execute();
        */
        /*
        $a = array('a', 'b', 'c');
        $ser = serialize($a);

        var_dump(unserialize($ser));
        die();
        */

/*
        var_dump(unserialize('a:16:{s:8:"LMI_MODE";s:1:"1";s:18:"LMI_PAYMENT_AMOUNT";s:5:"60.00";s:15:"LMI_PAYEE_PURSE";s:13:"R101111803389";
        s:14:"LMI_PAYMENT_NO";s:1:"0";s:12:"LMI_PAYER_WM";s:12:"261613619335";s:15:"LMI_PAYER_PURSE";s:13:"R101111803389";
        s:19:"LMI_PAYER_COUNTRYID";s:2:"UA";s:20:"LMI_PAYER_PCOUNTRYID";s:2:"UA";s:12:"LMI_PAYER_IP";s:13:"92.112.224.23";
        s:15:"LMI_SYS_INVS_NO";s:3:"371";s:16:"LMI_SYS_TRANS_NO";s:3:"699";s:18:"LMI_SYS_TRANS_DATE";s:17:"20150706 15:11:10";
        s:8:"LMI_HASH";s:64:"481A6C7608C641CC06BEC0EF01479D42D2316C3CEDA5A4F9D4B78E826BB6E4ED";s:16:"LMI_PAYMENT_DESC";s:0:"";}'));
        die();
*/



        $TransactionWm = new TransactionWm;
        // $postDataAr = $testData;
        $postDataAr = Yii::$app->request->post();
        if ( !empty($postDataAr ['LMI_PAYMENT_DESC']) )
        {
            $postDataAr ['LMI_PAYMENT_DESC'] = mb_convert_encoding($postDataAr ['LMI_PAYMENT_DESC'], 'UTF-8', 'Windows-1251');
        }
        $postDataAr ['description'] = base64_encode(serialize($postDataAr));

        $TransactionWm->load($postDataAr, '');

        $TransactionWm->save();

        return $this->render('stat');
    }

}

