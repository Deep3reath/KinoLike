<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Авторизация';

?>
<div class="site-login">
    <h1 class="login__title"><?= Html::encode($this->title) ?></h1>

<div class="login__form">
    <?php $form = ActiveForm::begin([
        'id' => 'login-form',
    ]); ?>
    <label>Логин
        <?= $form->field($model, 'username')->textInput(['placeholder'=>'Введите ваш логин..'])->label(false) ?>
    </label>
    <label>Пароль
        <?= $form->field($model, 'password')->passwordInput(['placeholder' => 'Введите ваш пароль..'])->label(false) ?>
    </label>
        <?= $form->field($model, 'rememberMe')->checkbox([])->label('Запомнить') ?>

        <div class="form-group-login">
                <?= Html::submitButton('Войти', ['class' => 'btn btn-like', 'name' => 'login-button']) ?>
        </div>

    <?php ActiveForm::end(); ?>
</div>
</div>

