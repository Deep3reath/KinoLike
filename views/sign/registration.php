<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\User */
/* @var $form ActiveForm */


$this->title = 'Регистрация';
?>

<div class="sign-registration">
    <h1 class="login__title"><?= Html::encode($this->title) ?></h1>
    <div class="login__form">
    <?php $form = ActiveForm::begin([
        'options' => [
            'enctype' => 'multipart/form-data'
        ]
    ]); ?>

        <?= $form->field($model, 'email')->textInput(['placeholder' => 'Введите ваш email..']) ?>
        <?= $form->field($model, 'name')->textInput(['placeholder' => 'Введите ваше имя..']) ?>
        <?= $form->field($model, 'username')->textInput(['placeholder' => 'Введите ваш логин..']) ?>
        <?= $form->field($model, 'password')->input('password', ['placeholder'=>'Введите ваш пароль..']) ?>
        <?= $form->field($model, 'avatar')->fileInput(['required'=>true, 'class' => 'avatar-upload'])
            ->label('Загрузить Аватар', ['class'=>'custom-file-upload']) ?>

        <div class="form-group-signup">
            <?= Html::submitButton('Присоединиться', ['class' => 'btn btn-like signup-btn']) ?>
        </div>
    <?php ActiveForm::end(); ?>
    </div>
</div><!-- sign-registration -->
