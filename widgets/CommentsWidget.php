<?php


 namespace app\widgets;
 use Yii;
 use yii\base\Widget;
 use yii\helpers\Html;

 class CommentsWidget extends Widget {
    public $comments;
    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        if ($this->comments['comments'] == null) $this->comments = false;
    }

    public function cycleRenderingComments($user, $review, $type, $text)
    {
         return $this->render('comments',
             [
                 'user'=>$user,
                 'review' => $review,
                 'type' => $type,
                 'text' => $text,
             ]
         );
    }

     public function run()
     {
         switch ($sort = Yii::$app->request->get('sort'))
         {
             case null: $range = 5; break;
             case 1: $range = 10; break;
             case 2: $range = 20; break;
             case 3: $range = 30; break;
             case 4: $range = null; break;
         }
         $i = 1;
         if($this->comments == false) return false;
         foreach ($this->comments['comments'] as $commentLine) {
             if ($i == $range && $i !== null) break;
             foreach ($this->comments['users'] as $userLine) {
                 if($userLine->id == $commentLine->id_user) {
                     $user = ['username'=>$userLine->username, 'reviews' => $this->comments['reviews']($commentLine->id_user), 'avatar' => $userLine->avatar];
                     $review = $commentLine->review;
                     $type = $commentLine->type;
                     $text = $commentLine->text;
                     echo $this->cycleRenderingComments($user, $review, $type, $text);
                 }
             }
             ++$i;
         }
         if ($i > 4) {
             if ($sort <= 3) echo Html::a('Показать больше', 'view?id=' . Yii::$app->request->get('id') . '&sort=' . ++$sort, ['class' => 'btn btn-like']);
             if ($range !== 5) echo Html::a('Вернуться', 'view?id=' . Yii::$app->request->get('id'), ['class' => 'btn btn-like back-comment']);
         }
     }
 }