<?php
use yii\helpers\Html;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="<?php Yii::$app->request->baseUrl ?>/css/index.css" rel="stylesheet" />
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>

<div class="container">
    <header class="header">

        <?php echo $this->render('_menu_php'); ?>

        <div>
            <img class="text-muted" src="<?php Yii::$app->request->baseUrl ?>/img/logo.png">
        </div>

    </header>

    <?= Breadcrumbs::widget([
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>
    <?= $content ?>

    <footer class="footer">
        <p class="pull-left">
        <div class="row">
            <div class="col-md-4">
                <a href="#">SKYPE:</a>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <a href="#">Email:</a>
            </div>
        </div>
        </p>
        <p class="pull-right">&copy; Cyborg Games <?= date('Y') ?></p>

    </footer>
</div> <!-- /container -->

<?php $this->endBody() ?>

<script type="text/javascript">
    window.jQuery || document.write('<script src="<?php Yii::$app->request->baseUrl ?>/js/jquery-1.11.3.min.js"><\/script>');
    (typeof $.fn.modal === "function") || document.write('<script src="<?php Yii::$app->request->baseUrl ?>/js/bootstrap-3.3.5.min.js"><\/script>');
</script>

</body>
</html>
<?php $this->endPage() ?>
