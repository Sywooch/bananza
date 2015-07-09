<?php
use yii\bootstrap\Button;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use app\models\Order;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\Order $Order
 * @var app\models\App $App
 */

?>

<script type="text/javascript">

    function toggleCity(cb, c_title){
        var d_title = $('dropdown_title');
        if (cb.checked){
            var newCityTitle = new Element('span', {
                'id': 'city_title_' + cb.value,
                'html': c_title + ', '
            });

            var issetCities = d_title.getElements('span');

            if (issetCities.length == 0){
                d_title.empty();
            }

            newCityTitle.inject(d_title, 'bottom');
        }
        else{
            d_title.getElement('#city_title_' + cb.value).destroy();

            var issetCities = d_title.getElements('span');

            if (issetCities.length == 0){
                d_title.set('html', 'Р»СЋР±Р°СЏ СЃС‚СЂР°РЅР°');
            }
        }

        return false;
    }

</script>

<div class="form">

    <?php $form = ActiveForm::begin(['layout' => 'horizontal']); // echo Html::beginForm(); ?>

    <?php // echo $form->errorSummary($Order); ?>

    <?php echo $form->field($App, 'name')->textInput(); ?>
    <?php echo $form->field($App, 'service_appname')->textInput(); ?>
    <?php echo $form->field($Order, 'ref_link')->textInput(); ?>
    <?php echo $form->field($Order, 'description')->textarea(); ?>

    <?php // echo $form->field($model, 'uploadFile')->fileInput() ?>

    <?php $countryList = ArrayHelper::map(\app\models\Country::find()->orderBy('id')->all(), 'id', 'name') ?>
    <?php echo $form->field($Order, 'countryIds[]')->checkboxList($countryList); // CountryIncludeToOrder[] checkboxList?>

    <?php echo $form->field($Order, 'total_users')->textInput(); ?>

    <?php $voteMarkList = ArrayHelper::map(\app\models\VoteMark::find()->orderBy('id')->all(), 'id', 'name') ?>
    <?php echo $form->field($Order, 'vote_mark_id')->dropDownList($voteMarkList); // , ['prompt' => ''])->label('Оценка для отзыва') ?>

    <?php echo $form->field($Order, 'goal_id')->hiddenInput(['value' => Order::GOAL_DOWNLOAD_VOTE]); ?>

    <?php echo Button::widget([
        'label' => 'Добавить',
        'options' => [
            'class' => 'btn-lg btn-success',
            'style' => 'margin:5px'
        ]
    ]); ?>

    <?php ActiveForm::end(); ?>
</div>