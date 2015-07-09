<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <div class="container header-logo">
            <img src="<?php Yii::$app->request->baseUrl ?>/img/logo.png" width="277" height="125" border="0" />
            <img src="<?php Yii::$app->request->baseUrl ?>/img/lighting.png" width="213" height="92" border="0" />
        </div>

        <?php
        $menuExtraItems = [];
        if (Yii::$app->user->isGuest) {
            $menuExtraItems[] = ['label' => 'Signup', 'url' => ['/user/signup']];
            $menuExtraItems[] = ['label' => 'Login', 'url' => ['/user/login']];
        } else {
            $menuExtraItems[] = [
                'label' => 'Logout (' . Yii::$app->user->identity->email . ')',
                'url' => ['/user/logout'],
                'linkOptions' => ['data-method' => 'post']
            ];

            $menuExtraItems[] = ['label' => 'Мои заказы', 'url' => ['/order/index'], 'items' => [
                ['label' => 'Список заказов', 'url' => ['/order/index']],
                ['label' => 'Создать заказ', 'url' => ['/order/create']],
                ['label' => 'Оплатить заказ', 'url' => ['/payment']],
            ]];

            $menuExtraItems[] = ['label' => 'Оплата услуг', 'url' => ['/payment/index']];
        }


        NavBar::begin([
                'brandLabel' => 'Cyborg Games',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'navbar-container', // navbar-inverse navbar-fixed-top
                ],
                'containerOptions' => [
                    'class' => 'navbar-item',
                ],
            ]);
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => array_merge([
                    ['label' => Yii::t('menu', 'Home'), 'url' => ['/site/index']],
                    ['label' => Yii::t('menu', 'Contacts'), 'url' => ['/site/contact']],

                    ['label' => Yii::t('menu', 'Customer Info'), 'url' => ['/site/customer']],
                    ['label' => Yii::t('menu', 'Executor Info'), 'url' => ['/site/executor']],
                    ['label' => Yii::t('menu', 'FAQ'), 'url' => ['/site/faq']],
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
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

    <footer class="footer">
        <div class="container">
            <p class="pull-left">&copy; Cyborg Games <?= date('Y') ?></p>
            <p class="pull-right"><?= Yii::powered() ?></p>
        </div>
    </footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
