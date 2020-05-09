<?php

use kartik\date\DatePicker;
use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Films */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="films-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'country')->textarea(['rows' => 6]) ?>

    <label>Дата</label>
    <?= DatePicker::widget([
        'name' => 'Films[date]',
        'value' => date('Y-m-d', strtotime('+2 days')),
        'options' => ['placeholder' => 'Выберите дату выхода ...'],
        'pluginOptions' => [
            'format' => 'dd-mm-yyyy',
            'todayHighlight' => true
        ]
    ]);?>
    <?= $form->field($model, 'operator')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'file')->label('Превью')->fileInput(['rows' => 6]) ?>

    <?= $form->field($model, 'screenwriter')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'producer')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
