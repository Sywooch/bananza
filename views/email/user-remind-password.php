<?php

use yii\helpers\Url;

/**
* @var yii\web\View $this
* @var app\models\User $User
*
*/
?>

Здравствуйте, <?php echo $User->name; ?>!<br />
<br />
Вы послали запрос на изменние пароля на сайте <?php Yii::$app->params['siteName']; ?>.<br />
Для изменения пароля пройдите по следующей ссылке <a target="_blank" href="<?php echo Url::toRoute(['/user/recover-password', 'link' => $User->activation_link]);?>"><?php echo Url::toRoute(['/user/recover-password', 'link' => $User->activation_link]);?></a>.<br />
Если это были не Вы - просто проигнорируйте данное сообщение.<br />
<br />
С уважением, поддержка <?php Yii::$app->params['siteName']; ?>.