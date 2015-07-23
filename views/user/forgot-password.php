<?php

use yii\bootstrap\Button;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $error string */

$this->title = Yii::t('user', 'Recover Password');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-forgot-password">
    <h1><?= Html::encode($this->title) ?></h1>

    <p><?php echo Yii::t('user', 'Please fill your email to recover password:'); ?></p>

    <?php $form = ActiveForm::begin([
        'id' => 'forgot-password-form',
        'options' => ['class' => 'form-horizontal'],
        'fieldConfig' => [
            'template' => "{label}\n<div class=\"col-lg-3\">{input}</div>\n<div class=\"col-lg-8\">{error}</div>",
            'labelOptions' => ['class' => 'col-lg-1 control-label'],
        ],
    ]); ?>

    <?php echo $form->field($model, 'username')->textInput(); ?>

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
</div>
