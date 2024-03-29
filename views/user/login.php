<?php

use yii\bootstrap\Button;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

$this->title = Yii::t('main', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php echo Html::a(Yii::t('user', 'Forgot Password?'), Url::toRoute('/user/forgot-password')); ?>
    <p><?php echo Yii::t('main', 'Please fill out the following fields to login:'); ?></p>

    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?= $form->field($model, 'username') ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'rememberMe', [
        'template' => "<div class=\"col-lg-offset-1 col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
    ])->checkbox() ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?php echo Button::widget([
                'label' => Yii::t('user', 'Login'),
                'options' => [
                    'name' => 'login-button',
                    'class' => 'btn-lg btn-primary',
                    'style' => 'margin:5px',
                ]
            ]); ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
</div>
