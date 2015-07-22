<?php

namespace app\controllers;

use app\models\Country;
use app\models\Goal;
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
        $Order = Order::find()->with(['countries', 'app', 'goals'])->where(['id' => $id])->one();
        $Order->countryIds = ArrayHelper::map($Order->countries, 'id', 'id');
        $Order->goalIds = ArrayHelper::map($Order->goals, 'id', 'id');

        $postData = Yii::$app->request->post();

        if ( !empty($postData) && $this->saveOrder($postData, $Order) )
        {
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
        $Order->load($postData);
        $Order->countryIds = [];
        $Order->app->load($postData);

        $flagOrder = $Order->validate();
        $flagApp = $Order->app->validate();

        $flagValid = $flagOrder && $flagApp;
        /*
        var_dump($Order->getErrors());
        var_dump($Order->app->getErrors());
        var_dump($Order->app->name);

            var_dump($flagValid); die();
        */

        if ( $flagValid )
        {
            $transaction = Yii::$app->db->beginTransaction();

            try {
                $extraColumns = []; // extra columns to be saved to the many to many table
                $unlink = true; // unlink tags not in the list
                $delete = true; // delete unlinked tags

                $Order->app->save(FALSE);
                $Order->link('app', $Order->app, $extraColumns, $unlink, $delete);
                // $Order->app_id = $Order->app->id;

                $Order->save(FALSE);
                // $CountriesInclude = Country::findAll(['id' => $Order->countries]);
                $CountriesInclude = Country::findAll(['id' => $Order->countryIds]);
                // var_dump($CountriesInclude);die();
                // $Order->linkAll('countries', $CountriesInclude, $extraColumns, $unlink, $delete);
                $Order->linkAll('countries', $CountriesInclude, $extraColumns, $unlink, $delete);

                $Goals = Goal::findAll(['id' => $Order->goalIds]);

                $Order->linkAll('goals', $Goals, $extraColumns, $unlink, $delete);

                $transaction->commit();

                $this->redirect(Url::toRoute('order/'));

            } catch (Exception $e) {

                $transaction->rollBack();

            }
        }


    }

    public function actionCreate()
    {

        // Если пришли данные для сохранения
        $Order = new Order();
        $App = new App();
        $App->type = App::TYPE_FREE;
        $App->service = App::SERVICE_GOOGLE;

        $Order->app = $App;

        $postData = Yii::$app->request->post();
        if ( !empty($postData) )
        {
            $this->saveOrder($postData, $Order);
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