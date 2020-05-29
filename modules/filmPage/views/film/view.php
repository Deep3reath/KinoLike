<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\widgets\DetailView;
use app\widgets\CommentsWidget;
/* @var $this yii\web\View */
/* @var $model app\models\Films */
/* @var $modelComments app\models\Comments */
/* @var $comments  */
/* @var $genresView */
/* @var $ratingView */
/* @var $viewedView */
/* @var $favoritesView */
/* @var $averageRating */
/* @var $searchModel */
/* @var $dataProvider */

$this->title = $model->title;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
$templateGenres = function ($data) {
    foreach ($data as $genre) {
        ?>
        <div class="genre">
            <p><?=$genre?></p>
        </div>
        <?php
    }
};

?>
<div class="films-view-header">
    <h1 class="film__header"><?= Html::encode($this->title) ?></h1>
    <div class="film__preview_image-container">
    <?= Html::img('@web/'.$model->img, ['class' => 'preview-image']) ?>
    </div>
    <div class="header__title-container">
        <?php if (!Yii::$app->user->isGuest): ?>
        <div class="film__rating_choose-container">

            <?php if($ratingView == null) :
            $form = ActiveForm::begin(['action' => 'class-film']);
            ?>
            <?= $form->field($model, 'id_film')->input('hidden', ['value' => $model->id])->label(false) ?>
            <?= $form->field($model, 'num')->dropDownList([1=>1, 2=>2, 3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10])->label('Поставить оценку') ?>
            <?= Html::submitButton('Сохранить', ['class' => 'btn btn-like']) ?>
            <?php ActiveForm::end(); ?>
            <?php else: ?>
            <h4>Ваша оценка фильму:</h4>
            <p><?= $ratingView->num; ?>/10</p>
            <?php endif; ?>

        </div>


    <div class="film__btn-container">

        <?php if ($viewedView == null) : ?>
        <?= Html::a('Добавить в просмотренное', ['add-viewed', 'id' => $model->id], ['class' => 'btn btn-like']) ?>
        <?php else: ?>
        <?= Html::a('Убрать из просмотренного', ['del-viewed', 'id' => $model->id], ['class' => 'btn btn-like']) ?>
        <?php endif; ?>
        <?php if ($favoritesView == null) : ?>
        <?= Html::a('Добавить в избранное', ['add-favorites', 'id' => $model->id], ['class' => 'btn btn-like']) ?>
        <?php else: ?>
        <?= Html::a('Убрать из избранного', ['del-favorites', 'id' => $model->id], ['class' => 'btn btn-like']) ?>
        <?php endif; ?>

    </div>
        <?php endif; ?>
    <div class="film__genres-container">
        <?php $templateGenres($genresView($model->id))?>
    </div>
    <div class="film__information-container" style="margin-left: 60px;">
        <div class="film__information-item">
            <p class="film__information-text">Дата премьеры</p><p><?= $model->date?></p>
        </div>

        <div class="film__information-item">
            <p class="film__information-text">Сценарий</p><p><?= $model->screenwriter?></p>
        </div>

        <div class="film__information-item">
            <p class="film__information-text">Оператор</p><p><?= $model->operator?></p>
        </div>

        <div class="film__information-item">
            <p class="film__information-text">Продюссер</p><p><?= $model->producer?></p>
        </div>

        <div class="film__information-item">
            <p class="film__information-text">Страна</p><p><?= $model->country?></p>
        </div>

        <div class="film__information-item">
            <p class="film__information-text">Рейтинг</p><p><?= $averageRating($model->id)?>/10</p>
        </div>
    </div>
    </div>
</div>
<div class="film-view__description-container">
    <div class="description-container">
    <h5>Описание:</h5>
    <p>
        <?= $model->description?>
    </p>
    </div>
</div>

<div class="film-view__comments-container">
    <h4>Комментарии</h4>
    <?= CommentsWidget::widget(['comments' => $comments]); ?>
</div>
<?php if (!Yii::$app->user->isGuest): ?>
<div class="film-view__comments-form-container">
    <h4>Оставить отзыв</h4>
    <?php $form = ActiveForm::begin(['action' => "comment-add?id=".$model->id]);
    ?>
    <div class="textarea-comment">
    <?= $form->field($modelComments, 'text')->textarea(['maxlength' => true, 'placeholder' => 'Напишите ваш отзыв..'])->label('Текст') ?>
    </div>
    <?php if (Yii::$app->user->identity->id_role !== 4): ?>
    <div class="film-view__comment-form-review">
        <input id="review-comment" type="radio" name="review" value="0">
        <label for="review-comment"></label>
        <input id="review-review" type="radio" name="review" value="1">
        <label for="review-review"></label>
    </div>
    <?php else: ?>
        <?='<input type="hidden" name="review" value="0">' ?>
    <?php endif; ?>
    <div class="film-view__comment-form-type">
        <input id="type-positive" type="radio" name="type" value="0">
        <label for="type-positive"></label>
        <input id="type-negative" type="radio" name="type" value="1">
        <label for="type-negative"></label>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Отправить', ['class' => 'btn btn-like']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
<?php endif; ?>