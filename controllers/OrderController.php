<?php

namespace app\controllers;

use app\models\CountryIncludeToOrder;
use app\models\GoalToOrder;
use app\models\Task;
use Yii;
use yii\data\ActiveDataProvider;
use yii\db\ActiveRecord;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\helpers\ArrayHelper;

use app\models\Order;
use app\models\App;
use yii\helpers\Url;


class OrderController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['create'],
                'rules' => [
                    [
                        'actions' => ['create'],
                        'allow' => true,
                        'roles' => ['@'],
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

    /**
     * Lists all Order models.
     * @return mixed
     */
    public function actionIndex()
    {
        $dataProvider = new ActiveDataProvider([
            'query' => Order::find()->where(['user_id' => Yii::$app->getUser()->getId()]),
        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Updates an existing Order model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        // $Order = Order::findOne($id)->with('countries');
        $Order = Order::find()->with(['countries', 'app'])->where(['id' => $id])->one();
        // vd($Order->app, true);
        // vd($Order->getCountryIncludeToOrders(), true);
        $Order->countryIds = ArrayHelper::map($Order->countries, 'id', 'id');
        // vd($Order->countryIds, true);
        // $a = $Order->getApp(;
        // vd($a, true);

        $postData = Yii::$app->request->post();

        if ( !empty($postData) && $this->saveOrder($postData, $Order) ) {

            return $this->redirect(['view', 'id' => $Order->id]);
        } else {
            return $this->render('update', [
                'Order' => $Order,
                'App' => $Order->app,
            ]);
        }
    }

    private function saveOrder($postData, Order $Order )
    {
        if ( $Order->validate() )
        {
            $Order->app->load($postData);

            if ( $Order->app->validate() )
            {

                $transaction = Yii::$app->db->beginTransaction();

                try {
                    $Order->app->load($postData);
                    $Order->app->save();

                    $Order->load($postData);
                    $Order->app_id = $Order->app->id;

                    $Order->save(false);
                    $valuesAr = [];
                    foreach ( $Order->countryIds as $countryId )
                    {
                        $valuesAr [] = [$Order->id, $countryId];
                    }

                    CountryIncludeToOrder::deleteAll(['order_id' => $Order->id]);
                    Yii::$app->db->createCommand()
                        ->batchInsert(CountryIncludeToOrder::tableName(), ['order_id', 'country_id'], $valuesAr)->execute();

                    GoalToOrder::deleteAll(['order_id' => $Order->id]);
                    $Goal = new GoalToOrder();
                    $Goal->order_id = $Order->id;
                    $Goal->goal_id = $Order->goal_id;
                    $Goal->save();

                    $transaction->commit();

                    $this->redirect(Url::toRoute('order/'));

                } catch (Exception $e) {

                    $transaction->rollBack();

                }
            }
        }


    }

    public function actionCreate()
    {
/*

        $customer = new Customer();
        $customer->load(Yii::$app->request->post());
$customer->save();

$order = new Order();
$order->load(Yii::$app->request->post());
$customer->link('order', $order); //automatically saved into database

        // $customer = Customer::find()->with('orders')->all();

        $customer = Customer::findOne(123);
        $order = new Order();
        $order->subtotal = 100;
// ...

        $order->link('customer', $customer);



        $customer = new Customer();

$customer->save();

$order = new Order();
$order->load(Yii:$app->request->post());
$customer->link('order', $order); //automatically saved into database
*/


        // vd(Yii::$app->user->getId());
        // vd(Yii::$app->user->identity);

        // Если пришли данные для сохранения
        $Order = new Order();
        $postData = Yii::$app->request->post();
        if ( !empty($postData) )
        {
            var_dump($postData);
            $Order->load($postData);
            // var_dump($Order->app);
            // die();

            $this->saveOrder($postData, $Order);

            /*
            $transaction = Yii::$app->db->beginTransaction();

            try {
                $App->load($postData);
                $App->save();

                $Order->load($postData);
                $Order->app_id = $App->id;
                $Order->save(false);
            // vd($Order->id);
                // $Order->countries = $Order->countryIds;

                $extraColumns = []; // extra columns to be saved to the many to many table
                $unlink = true; // unlink tags not in the list
                $delete = true; // delete unlinked tags
                // vd($Order);
                // vd($postData);die();
                // vd($Order->countryIds);die();

                // var_dump($Order->getIsNewRecord());die();
                $CountriesInclude = [];
                $valuesAr = [];
                foreach ( $Order->countryIds as $countryId )
                {
                    $valuesAr [] = [$Order->id, $countryId];
                    //$CountryInclude = new CountryIncludeToOrder();
                    //$CountryInclude->country_id = $countryId;
                    // $CountriesInclude [] = $CountryInclude;
                }
            // $Order->linkAll('countries', $CountriesInclude, $extraColumns, $unlink, $delete);
            // die();
                CountryIncludeToOrder::deleteAll(['order_id' => $Order->id]);
                Yii::$app->db->createCommand()
                    ->batchInsert(CountryIncludeToOrder::tableName(), ['order_id', 'country_id'], $valuesAr)->execute();

                GoalToOrder::deleteAll(['order_id' => $Order->id]);
                $Goal = new GoalToOrder();
                $Goal->order_id = $Order->id;
                $Goal->goal_id = $Order->goal_id;
                $Goal->save();

// vd($Order->countryIds);die();
                // $Order->linkAll('countries', $CountriesInclude, $extraColumns, $unlink, $delete);

                // $Order->save();



                // $App->link('userAddress', $App); // <-- it creates new record in UserAddress table with ua.user_id = user.id

                $transaction->commit();

                // $this->redirect(Url::toRoute('order/'));
                return $this->goHome();

            } catch (Exception $e) {

                $transaction->rollBack();

            }
            */

            // Безопасное присваивание значений атрибутам
            // $Order->attributes = $_POST ['Order'];

            //vd($user, true);
/*
            // Проверка данных
            if ( $Order->validate() )
            {
                // Сохранить полученные данные
                // false нужен для того, чтобы не производить повторную проверку
                $Order->save(false);
                // Перенаправить на список зарегестрированных пользователей
                $this->redirect(Url::toRoute('order/'));
            }
*/
        }
        else
        {
            // $Order = new Order();
            // $Order->user_id = Yii::$app->user->getId();

            $App = new App();
            $App->type = App::TYPE_FREE;
            $App->service = App::SERVICE_GOOGLE;

            $Order->app = $App;
        }



        return $this->render('create', ['Order' => $Order, 'App' => $App]);
    }

    /**
     * Deletes an existing Order model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $Order = Order::findOne($id);
        $Order->delete();

        // Order::findOne($id)->delete();

        return $this->redirect(['index']);
    }
}