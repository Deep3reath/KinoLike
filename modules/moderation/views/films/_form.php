<?php

use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Films */
/* @var $genres app\models\Genres */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="films-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'country')->textInput() ?>

    <?= $form->field($model, 'operator')->textInput() ?>

    <?= $form->field($model, 'screenwriter')->textInput() ?>

    <?= $form->field($model, 'producer')->textInput() ?>

    <label>Дата выхода</label>
    <?= DatePicker::widget([
        'name' => 'Films[date]',
        'value' => date('Y-m-d', strtotime('+2 days')),
        'options' => ['placeholder' => 'Выберите дату выхода ...'],
        'pluginOptions' => [
            'format' => 'yyyy-mm-dd',
            'startDate' => '1900.01.01.',
            'endDate' => date('Y-m-d'),
        ]
    ]);?>

    <?= $form->field($model, 'genres')->checkboxList(ArrayHelper::map($genres->getGenresList(), 'id', 'title'))->label('Жанры') ?>

    <?= $form->field($model, 'file')->label('Превью')->fileInput() ?>
    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
