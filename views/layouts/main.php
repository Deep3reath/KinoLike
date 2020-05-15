<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    $options = [
            'class' => 'navbar-nav navbar-right'
    ];
    $items = [
        ['label' => 'Главная', 'url' => ['/site/index']],
    ];
    if (!Yii::$app->user->isGuest):
    $logout = '<li>'
        . Html::beginForm(['/sign/logout'], 'post')
        . Html::submitButton(
            'Выйти',
            ['class' => 'btn btn-like logout']
        )
        . Html::endForm()
        . '</li>';
    endif;
    if (Yii::$app->user->isGuest) {
        array_push($items, ['label' => 'Регистрация', 'url' => ['/sign/registration']]);
        array_push($items, ['label' => 'Авторизация', 'url' => ['/sign/authentication']]);
    } elseif (Yii::$app->user->identity->id_role == 1) {
        array_push($items, ['label' => 'Панель Администратора', 'url' => ['/administration']]);
        array_push($items, $logout);
    } elseif (Yii::$app->user->identity->id_role == 2) {
        array_push($items, ['label' => 'Панель модератора', 'url' => ['/moderation']]);
        array_push($items, $logout);
    } else {
        array_push($items, ['label' => 'Профиль', 'url' => ['/profile']]);
        array_push($items, $logout);
    }
    NavBar::begin([
        'brandLabel' => Html::img('@web/assets/site/logotype.svg', ['class'=> 'logotype','alt'=>Yii::$app->name]),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top  header-container',
        ],
    ]);
    echo Nav::widget([
        'options' => $options,
        'items' =>
            $items,
    ]);
    NavBar::end();
    ?>

    <div class="container container-main">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container ">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
