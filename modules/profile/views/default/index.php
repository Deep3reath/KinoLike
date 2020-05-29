<?php

use yii\imagine\Image;
use yii\helpers\Html;

/* @var $favorites  \app\models\Favorites*/
/* @var $user  \app\models\User*/
/* @var $viewed  \app\models\Viewed*/
/* @var $comments  \app\models\Comments*/
/* @var $commentsCount */
/* @var $viewedCount */
/* @var $favoritesCount */
/* @var $reviewCount */
/* @var $filmViewed */
/* @var $filmFavorites */
/* @var $filmRatingCount */
/* @var $genresView */

?>
<?php
$templateGenres = function ($data) {
    $i = 0;
    foreach ($data as $genre) {

        ?>
        <div class="genre">
            <p><?=$genre?></p>
        </div>
    <?php
         if($i >= 4) break;
         ++$i;
    }
}
?>



<div class="text-center container profile-container profile-wrapper">
    <h1 class="profile__header">Профиль</h1>
    <h3 class="profile__username"><?= Yii::$app->user->identity->username?></h3>
    <div class="profile__avatar-container">
        <?= Html::img('upload/avatars/'.Yii::$app->user->identity->avatar, ['class' => 'avatar']); ?>
    </div>
    <hr>
    <div class="profile__simple_statistic-container">
        <div class="simple_statistic__item">
            <h5>Просмотрено</h5>
            <p><?= $viewedCount;?></p>
        </div>
        <div class="simple_statistic__item">
            <h5>В избранном</h5>
            <p><?= $favoritesCount;?></p>
        </div>
        <div class="simple_statistic__item">
            <h5>Комментариев</h5>
            <p><?= $commentsCount;?></p>
        </div>
        <div class="simple_statistic__item">
            <h5>Рецензий</h5>
            <p><?= $reviewCount;?></p>
        </div>
    </div>
    <hr>

    <div class="profile__viewed-container">
        <div class="viewed__wrapper">
            <div class="viewed__header">
                <h4>Последнее в просмотренном</h4>
            </div>
            <div class="viewed__item">
                <?php if($filmViewed !== null): ?>
                <?= Html::img($filmViewed->img, ['class'=> 'viewed__film-img', 'alt' => 'Last viewed film picture']) ?>
                <div class="viewed__item-text">
                    <h5><?= $filmViewed->title?></h5>
                    <div class="information">
                    <p>Год выпуска: <?= $filmViewed->date?></p>
                    <p>Проголосовало: <?= $filmRatingCount($filmViewed->id);?></p>
                    </div>
                    <div class="genres-template">
                    <?php $templateGenres($genresView($filmViewed->id)); ?>
                    </div>
                </div>
                <div class="viewed__item-links">
                    <a href="film-page/film/view?id=<?= $filmViewed->id?>" class="btn btn-like">Перейти к фильму</a>
                    <a href="profile/user-data/viewed" class="btn btn-like">Посмотреть все</a>
                </div>
                <?php else: ?>
                <div class="viewed__item-links">
                    <h3>У вас нету просмотренных фильмов</h3>
                    <div style="width: 450px">
                        <a href="site" class="btn btn-like" style="width: 120px;">Фильмы</a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <hr>
    <div class="profile__viewed-container">
        <div class="viewed__wrapper">
            <div class="viewed__header">
                <h4 style="margin-left: 115px;">Последнее в избранном</h4>
            </div>
            <div class="viewed__item">
                <?php if($filmFavorites !== null): ?>
                <?= Html::img($filmFavorites->img, ['class'=> 'viewed__film-img', 'alt' => 'Last viewed film picture']) ?>
                <div class="viewed__item-text">
                    <h5><?= $filmFavorites->title?></h5>
                    <div class="information">
                        <p>Год выпуска: <?= $filmFavorites->date?></p>
                        <p>Проголосовало: <?= $filmRatingCount($filmFavorites->id);?></p>
                    </div>
                    <div class="genres-template">
                        <?php $templateGenres($genresView($filmFavorites->id)); ?>
                    </div>
                </div>
                <div class="viewed__item-links">
                    <a href="film-page/film/view?id=<?= $filmFavorites->id?>" class="btn btn-like">Перейти к фильму</a>
                    <a href="profile/user-data/favorites" class="btn btn-like">Посмотреть все</a>
                </div>
                <?php else: ?>
                <div class="viewed__item-links">
                    <h3>У вас нету избранных фильмов</h3>
                    <div style="width: 450px;">
                    <a href="site" class="btn btn-like" style="width: 120px;">Фильмы</a>
                    </div>
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <hr>
    <div class="profile__gosus-container">
        <?php if(Yii::$app->user->identity->id_role == 4) : ?>
        <h4>Ваш статус - Пользователь</h4>
        <p>
            Чтобы оставлять рецензии, необходимо
            авторизоваться через сервис “Госуслуги”
        </p>
            <a href="#" class="btn btn-like">Госуслуги</a>
        <?php endif; ?>
    </div>
</div>
