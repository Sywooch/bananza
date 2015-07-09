<?php

use yii\helpers\Html;

use yii\bootstrap\Button;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Order;


/* @var $this yii\web\View */
/* @var $model app\models\Order */
/* @var $form yii\widgets\ActiveForm */
?>


<?php $form = ActiveForm::begin(['layout' => 'horizontal']); // echo Html::beginForm(); ?>

<?php // echo $form->errorSummary($Order); ?>

<?php echo $form->field($Order->app, 'name')->textInput(); ?>
<?php echo $form->field($Order->app, 'service_appname')->textInput(); ?>
<?php echo $form->field($Order, 'ref_link')->textInput(); ?>
<?php echo $form->field($Order, 'description')->textarea(); ?>

<?php // echo $form->field($model, 'uploadFile')->fileInput() ?>

<?php $countryList = ArrayHelper::map(\app\models\Country::find()->orderBy('id')->all(), 'id', 'name') ?>
<?php echo $form->field($Order, 'countryIds')->checkboxList($countryList); // CountryIncludeToOrder[] checkboxList?>

<?php echo $form->field($Order, 'total_users')->textInput(['value' => '10']); ?>

<?php $voteMarkList = ArrayHelper::map(\app\models\VoteMark::find()->orderBy('id')->all(), 'id', 'name') ?>
<?php echo $form->field($Order, 'vote_mark_id')->dropDownList($voteMarkList); // , ['prompt' => ''])->label('Оценка для отзыва') ?>

<?php echo $form->field($Order, 'goal_id')->hiddenInput(['value' => Order::GOAL_DOWNLOAD])->label(false); ?>

<?php echo Button::widget([
    'label' => $Order->isNewRecord ? Yii::t('main', 'Add') : Yii::t('main', 'Save'),
    'options' => [
        'class' => 'btn-lg btn-success',
        'style' => 'margin:5px'
    ]
]); ?>

