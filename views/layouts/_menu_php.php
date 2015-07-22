<?php
// use yii\bootstrap\Nav;
use kartik\nav\NavX;
use yii\bootstrap\NavBar;

$menuExtraItems = [];
if (Yii::$app->user->isGuest) {
    $menuExtraItems[] = ['label' => Yii::t('menu', 'Signup'), 'url' => ['/user/signup'], 'linkOptions' => ['class' => 'btn btn-lg btn-custom']];
    $menuExtraItems[] = ['label' => Yii::t('menu', 'Login'), 'url' => ['/user/login'], 'linkOptions' => ['class' => 'btn btn-lg btn-custom']];
} else {
    $menuExtraItems[] = [
        'label' => Yii::t('menu', 'Logout'), // (' . Yii::$app->user->identity->email . ')',
        'url' => ['/user/logout'],
        'linkOptions' => ['data-method' => 'post', 'class' => 'btn btn-lg btn-custom']
    ];

    $menuExtraItems[] = ['label' => Yii::t('menu', 'Orders'), 'linkOptions' => ['class' => 'btn btn-lg btn-custom'],
        'items' => [
            ['label' => Yii::t('menu', 'My Orders'), 'url' => ['/order/index']],
            ['label' => Yii::t('menu', 'Create Order'), 'url' => ['/order/create']],
            ['label' => Yii::t('menu', 'Finance'), 'url' => ['/payment']],
        ]];

    $menuExtraItems[] = ['label' => 'Мои заказы', 'url' => ['/order/index'], 'linkOptions' => ['class' => 'btn btn-lg btn-custom'],
        'items' => [
            ['label' => Yii::t('menu', 'My Orders'), 'url' => ['/order/index']],
            ['label' => Yii::t('menu', 'Create Order'), 'url' => ['/order/create']],
            ['label' => Yii::t('menu', 'Finance'), 'url' => ['/payment']],
        ]];

    $menuExtraItems[] = ['label' => 'Оплата услуг', 'url' => ['/payment/index'], 'linkOptions' => ['class' => 'btn btn-lg btn-custom']];
}

/*
NavBar::begin([
    // 'brandLabel' => 'Cyborg Games',
    // 'brandUrl' => Yii::$app->homeUrl,
    'options' => [
        'class' => '', // 'navbar-container', // navbar-inverse navbar-fixed-top
    ],

    'containerOptions' => [
        'class' => '', // 'navbar-item',
    ],
]);
*/
echo NavX::widget([
    // btn btn-lg btn-custom
    'options' => ['class' => 'nav navbar-nav navbar-right nav-pills pull-right vcenter btn-custom',/* 'navbar-nav navbar-right'*/],
    'items' => array_merge([
        ['label' => Yii::t('menu', 'Home'), 'url' => ['/site/index'], 'linkOptions' => ['class' => 'btn btn-lg btn-custom']],
        ['label' => Yii::t('menu', 'Contacts'), 'url' => ['/site/contact'], 'linkOptions' => ['class' => 'btn btn-lg btn-custom']],

//        ['label' => Yii::t('menu', 'Customer Info'), 'url' => ['/site/customer'], 'linkOptions' => ['class' => 'btn btn-lg btn-custom']],
//        ['label' => Yii::t('menu', 'Executor Info'), 'url' => ['/site/executor'], 'linkOptions' => ['class' => 'btn btn-lg btn-custom']],
        ['label' => Yii::t('menu', 'FAQ'), 'url' => ['/site/faq'], 'linkOptions' => ['class' => 'btn btn-lg btn-custom']],
        // ['label' => Yii::t('menu', 'Signup'), 'url' => ['/user/signup']],
        /*
                            ['label' => 'About', 'url' => ['/site/about']],

                            Yii::$app->user->isGuest ?
                                ['label' => 'Login', 'url' => ['/site/login']] :
                                ['label' => 'Logout (' . Yii::$app->user->identity->username . ')',
                                    'url' => ['/site/logout'],
                                    'linkOptions' => ['data-method' => 'post']],
        */
    ], $menuExtraItems),
]);
// NavBar::end();

?>