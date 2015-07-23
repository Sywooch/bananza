<?php

use yii\bootstrap\Button;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;


/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $form = ActiveForm::begin(['layout' => 'horizontal', 'fieldConfig' => [
    'horizontalCssClasses' => ['wrapper' => 'col-sm-8',]
]]); ?>

<?php // echo $form->errorSummary($Order); ?>

<?php echo $form->field($Order->app, 'name')->textInput(['placeholder' => 'Название приложения']); ?>
<?php echo $form->field($Order->app, 'service_appname')->textInput(['placeholder' => '(`XXXXXXXX` из https://play.google.com/store/apps/details?id=XXXXXXXX&feature...)']); ?>
<?php echo $form->field($Order, 'ref_link')->textInput(); ?>
<p class="help-block">(Необязательное поле. Указывать если необходим переход на трекинговые ссылки. Трекинговые системы засчитывают не просто инстал, а факт запуска. Поэтому необходимо брать проверку на запуск.)</p>
<br />
<?php echo $form->field($Order, 'description')->textarea(); ?>
<?php // echo $form->field($model, 'uploadFile')->fileInput() ?>
<?php $countryList = ArrayHelper::map(\app\models\Country::find()->orderBy('id')->all(), 'id', 'name') ?>
<?php// echo $form->field($Order, 'countries')->checkboxList($countryList, ArrayHelper::map($Order->countries, 'id', 'id')); // CountryIncludeToOrder[] checkboxList?>

<?php // echo $form->field($Order, 'countryIds')->checkboxList($countryList); // CountryIncludeToOrder[] checkboxList?>
<?php // echo $form->field($Order, 'countryIds')->hiddenInput(['value' => []])->label(false); ?>

<?php echo $form->field($Order, 'total_users')->textInput(['value' => '10']); ?>

<?php $periodList = [0 => 'без периода', '3600' => 'в час', '86400' => 'в сутки']; ?>
<?php echo $form->field($Order, 'period_seconds')->dropDownList($periodList); ?>
<?php echo $form->field($Order, 'period_value')->textInput(); ?>

<?php $voteMarkList = ArrayHelper::map(\app\models\VoteMark::find()->orderBy('id')->all(), 'id', 'name') ?>
<?php echo $form->field($Order, 'vote_mark_id')->dropDownList($voteMarkList); // , ['prompt' => ''])->label('Оценка для отзыва') ?>

<?php $goalList = ArrayHelper::map(\app\models\Goal::find()->orderBy('id')->all(), 'id', 'name') ?>
<?php echo $form->field($Order, 'goalIds')->checkboxList($goalList, ArrayHelper::map($Order->goals, 'id', 'id')); ?>

<div class="row vcenter2">
    <div class="col-xs-6" style="font-weight: bold">
        Общая сумма:
    </div>
    <div class="col-xs-2"></div>
    <div class="col-xs-2">
        <?php echo Button::widget([
            'label' => $Order->isNewRecord ? Yii::t('main', 'Add') : Yii::t('main', 'Save'),
            'options' => [
                'class' => 'btn-lg btn-success',
                'style' => 'margin:5px'
            ]
        ]); ?>

 <!--       <button class="btn btn-success btn-block greenColumn" type="submit"><h2>В Работу!</h2></button> -->
    </div>
    <div class="col-xs-2"></div>
</div>