<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Orders';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="order-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Create Order', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            // ['class' => 'yii\grid\SerialColumn'],

            'id',
            // 'user_id',
            // 'app_id',
            // 'vote_mark_id',
            // 'ref_link',
            'name',
            'description:ntext',
            // 'icon_filename',
            // 'total_users',
            // 'total_price',
            // 'status',
            // 'creation_date',
            // 'change_date',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>