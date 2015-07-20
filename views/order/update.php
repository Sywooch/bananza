<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Order */

$this->title = Yii::t('order', 'Update Order') . ': ' . ' ' . $Order->id;
$this->params['breadcrumbs'][] = ['label' => Yii::t('order', 'Orders'), 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $Order->id, 'url' => ['view', 'id' => $Order->id]];
$this->params['breadcrumbs'][] = Yii::t('main', 'Update');
?>
<div class="order-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'Order' => $Order,
        'App' => $App
    ]) ?>

</div>
