<?php
    use yii\bootstrap\Tabs;

/**
 * @var yii\web\View $this
 * @var yii\widgets\ActiveForm $form
 * @var app\models\User $model
 */

?>
<?php
echo Tabs::widget([
    'items' => [
        [
            'label' => 'Как Заказчик',
            'content' => $this->render('customer_form', ['model' => $model]),
            'active' => true
        ],
        [
            'label' => 'Как Исполнитель',
            'content' => $this->render('executor_form'),
            // 'active' => true
        ],
    ],
]);
?>