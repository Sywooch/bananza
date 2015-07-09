<?php
use kartik\slider\Slider;
?>

<html>
<head>
    <title>Pay</title>
</head>
<body>

<!--
<script src="//merchant.webmoney.ru/conf/lib/wm-simple-x20.min.js?wmid=261613619335&purse=R101111803389&key=642172351&amount=10.00&desc=%CE%EF%EB%E0%F2%E0+%E7%E0+%F3%F1%EB%F3%E3%E8" id="wm-script"></script>
-->

<form action="https://merchant.webmoney.ru/lmi/payment.asp" method="POST">
    <?php
// With model & without ActiveForm
    echo Slider::widget([
    'name' => 'LMI_PAYMENT_AMOUNT',
    // 'type' => SwitchInput::RADIO,
    'value' => 100,

     'sliderColor'=>Slider::TYPE_GREY,
     'handleColor'=>Slider::TYPE_DANGER,
    'pluginOptions'=>[

        'min' => 0,
        'max' => 2000,
        'step' => 10,
        'precision' => 2,

        'handle'=>'triangle',
        'tooltip'=>'always',
        'formatter' => new yii\web\JsExpression('function(val) {
            return val+" р."
        }'),
    ]
]);
?>

    <!-- <input type="text" name="LMI_PAYMENT_AMOUNT" value="10.00" /> -->
    <input type="hidden" name="LMI_PAYMENT_DESC_BASE64" value="0J7Qv9C70LDRgtCwINC30LAg0YPRgdC70YPQs9C4" />
    <input type="hidden" name="LMI_PAYEE_PURSE" value="R101111803389" />
    <input type="submit" class="wmbtn" style="font-famaly:Verdana, Helvetica, sans-serif!important;padding:0 10px;height:30px;font-size:12px!important;border:1px solid #538ec1!important;background:#a4cef4!important;color:#fff!important;" value="Оплатить" />
    <!--  &#1086;&#1087;&#1083;&#1072;&#1090;&#1080;&#1090;&#1100; 10.00 WMR  -->

</form>

<!--

<form id=pay name=pay method="POST" action="https://merchant.webmoney.ru/lmi/payment.asp" accept-charset="windows-1251" >
    <p>пример платежа через сервис Web Merchant Interface</p>
    <p>заплатить 1 WMZ...</p>
    <p>
        <input type="hidden" name="LMI_PAYMENT_AMOUNT" value="1.0" />
        <input type="hidden" name="LMI_PAYMENT_DESC" value="тестовый платеж" />
        <input type="hidden" name="LMI_PAYMENT_NO" value="1">
        <input type="hidden" name="LMI_PAYEE_PURSE" value="Z145179295679" />
        <input type="hidden" name="LMI_SIM_MODE" value="0" />
    </p>
    <p>
        <input type="submit" value="submit" />
    </p>
</form>
-->
</body>
</html>