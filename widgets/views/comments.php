<?php

/* @var $type */
/* @var $review */
use yii\helpers\Html;

$class = ['film-comment'];
switch ($type){
    case 0: $class[1] = 'film-comment-positive'; break;
    case 1: $class[1] = 'film-comment-negative'; break;
    case 2: $class[1] = 'film-comment-neutral';
}
$class [2] = $review ? 'film-comment-review' : null;
?>
<div class="<?= implode(' ', $class) ?>">
    <div class="comment-info">
        <h5><?= $user['username']; ?></h5>
        <div class="comment__avatar-container">
            <?= Html::img('/upload/avatars/'.$user['avatar'], ['class' => 'comment-avatar']); ?>
        </div>
        <p>Рецензий: <?= $user['reviews']; ?></p>
    </div>
    <div class="comment-text">
        <?= $text ?>
    </div>
</div>
