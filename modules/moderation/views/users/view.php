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

$temp = [];
foreach ($users->getRolesList() as $item) {
    $item->role == 'user' ? $temp[$item->id] = $item->role : null;
    $item->role == 'superuser' ? $temp[$item->id] = $item->role  : null;
    $item->role == 'banned' ? $temp[$item->id] = $item->role  : null;
}
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?> </h1>
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'label' => 'Аватар',
                'format' => 'raw',
                'value' => function ($data) {
                    return Html::img(('/upload/avatars/' . $data->avatar), [
                        'alt' => $data->avatar,
                        'style' => 'width:100px;'
                    ]);
                },
            ],
            'email:email',
            'name',
            'username',
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
    <?= $form->field($model, 'id_role')->dropDownList($temp)->label('Изменить роль') ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>


    <?php ActiveForm::end(); ?>
</div>
