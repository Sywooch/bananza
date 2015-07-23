<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $error string */

$this->title = Yii::t('user', 'Recover Password');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-forgot-password">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?php echo Yii::t('user', 'Letter was sent. Please check your email for instructions.'); ?></p>
    <?php echo Html::a(Yii::t('main', 'On Homepage'), '/'); ?>

</div>
