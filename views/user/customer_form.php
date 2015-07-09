<h1>Регистрация Заказчика</h1><br>

<?php
    use yii\bootstrap\ActiveForm;
    use yii\bootstrap\Button;
    use yii\captcha\Captcha;
?>

<div class="form">
    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); // echo Html::beginForm(); ?>

    <?php echo $form->errorSummary($model); ?>

    <?php echo $form->field($model, 'email')->textInput(); ?>
    <?php echo $form->field($model, 'name')->textInput(); ?>
    <?php echo $form->field($model, 'password')->passwordInput(); ?>
    <?php echo $form->field($model, 'password_repeat')->passwordInput(); ?>
    <?php echo $form->field($model, 'verifyCode')->widget(Captcha::className()); ?>
    <?php echo Button::widget([
        'label' => 'Зарегистрироваться',
        'options' => [
            'class' => 'btn-lg btn-success',
            'style' => 'margin:5px'
        ]
    ]); ?>

    <?php ActiveForm::end(); ?>
</div>