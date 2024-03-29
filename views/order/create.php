<?php
use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\Order $Order
 * @var app\models\App $App
 */



/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = Yii::t('order', 'Create Order');
$this->params['breadcrumbs'][] = ['label' => Yii::t('order', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] =  Yii::t('order', 'Create Order');
?>
<div class="order-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'Order' => $Order,
        'App' => $App
    ]) ?>

</div>


<?php
/*
echo Tabs::widget([
    'items' => [
        [
            'label' => 'Скачать приложение',
            'content' => $this->render('_create_download_app', ['Order' => $Order, 'App' => $App]),
            'active' => true
        ],
        [
            'label' => 'Скачать, оставить отзыв',
            'content' => $this->render('_create_vote_app', ['Order' => $Order, 'App' => $App]),
            // 'active' => true
        ],
        [
            'label' => 'Скачать + Скачать с отзывом',
            'content' => $this->render('_create_download_vote_app', ['Order' => $Order, 'App' => $App]),
            // 'active' => true
        ],
    ],
]);
*/
?>