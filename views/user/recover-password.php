<?php

use yii\bootstrap\Button;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $success boolean */

$this->title = Yii::t('user', 'Recover Password');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-recover-password">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php if ( !$success ): ?>

    <?php $form = ActiveForm::begin([
        'id' => 'recover-password-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?php echo $form->field($model, 'password')->passwordInput(); ?>
    <?php echo $form->field($model, 'password_repeat')->passwordInput(); ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?php echo Button::widget([
                'label' => Yii::t('main', 'Next'),
                'options' => [
                    'name' => 'login-button',
                    'class' => 'btn-lg btn-primary',
                    'style' => 'margin:5px',
                ]
            ]); ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

    <?php else: ?>
        <?php echo Yii::t('user', 'Password successfully changed. Please login with new credentials.'); ?>

    <?php endif; ?>
</div>
