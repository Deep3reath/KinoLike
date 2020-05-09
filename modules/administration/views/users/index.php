<?php

use app\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $roles  */
/* @var $user  */

$this->title = 'Пользователи';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="user-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'email:email',
            'name',
            'username',
            //'password',
            [
                'label' => 'Аватар',
                'format' => 'raw',
                'value' => function($data){
                    return Html::img(('@'.$data->avatar),[
                        'alt'=> $data->avatar,
                        'style' => 'width:100px;'
                    ]);
                },
            ],
            array(
                'label' => 'Роль',
                'format' => 'raw',
                'value' => function($data) {
                    return (\app\models\User::getRolesList($data->id))->role;
                },
            ),
            ['class' => 'yii\grid\ActionColumn', 'header'=>'Действия', 'template' => '{view} {delete}'],
        ],
    ]); ?>


</div>
