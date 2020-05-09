<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $users */
/* @var $model app\models\User */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Пользователи', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?> </h1>
    <p>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => "Вы хотите удалить пользователя - {$model->username}?",
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'email:email',
            'name',
            'username',
            [
                'label' => 'Аватар',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::img(('@' . $data->avatar), [
                        'alt' => $data->avatar,
                        'style' => 'width:100px;'
                    ]);
                },
            ],
            [
                'label' => 'Роль',
                'value' => function ($data) {
                    return (\app\models\User::getRolesList($data->id))->role;
                },
            ]
        ],
    ]) ?>
    <?php $form = ActiveForm::begin(['action' => 'change-role']);
    ?>
    <?= $form->field($model, 'id')->input('hidden', ['value' => $model->id])->label(false) ?>
    <?= $form->field($model, 'id_role')->dropDownList(ArrayHelper::map($users->getRolesList(), 'id', 'role'))->label('Изменить роль') ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>

    </div>


    <?php ActiveForm::end(); ?>
</div>
