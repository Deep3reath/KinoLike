<?php

namespace app\modules\filmPage\controllers;

use app\models\Comments;
use app\models\CommentsSearch;
use app\models\Favorites;
use app\models\Genres;
use app\models\Rating;
use app\models\User;
use app\models\UserSearch;
use app\models\Viewed;
use Yii;
use app\models\Films;
use app\models\FilmsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * FilmController implements the CRUD actions for Films model.
 */
class FilmController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Films models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new FilmsSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Films model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        if (!Yii::$app->user->isGuest) {
            return $this->render('view', [
                'model' => $this->findModel($id),
                'modelComments' => new Comments(),
                'comments' => ['comments' => CommentsSearch::find()->where(['id_film' => $id])->all(), 'users' => User::find()->all(),
                    'reviews' => function ($id_user) {
                        return Comments::find()->where(['id_user' => $id_user, 'review' => 1])->count();
                    }],
                'genresView' => $genresView = function ($id) {
                    return Genres::getGenresFilm($id);
                },
                'ratingView' => Rating::findOne(['id_film' => $id, 'id_user' => Yii::$app->user->identity->getId()]),
                'viewedView' => Viewed::findOne(['id_film' => $id, 'id_user' => Yii::$app->user->identity->getId()]),
                'favoritesView' => Favorites::findOne(['id_film' => $id, 'id_user' => Yii::$app->user->identity->getId()]),
                'averageRating' => function ($id) {
                    $temp = [];
                    foreach (Rating::find()->where(['id_film' => $id])->all() as $line) {
                        ;
                        array_push($temp, $line->num);
                    }
                    return $temp == null ? '?' : round(array_sum($temp) / count($temp), 1);
                },

            ]);
        } else {
            return $this->render('view', [
                'model' => $this->findModel($id),
                'modelComments' => new Comments(),
                'comments' => ['comments' => CommentsSearch::find()->where(['id_film' => $id])->all(), 'users' => User::find()->all(),
                    'reviews' => function ($id_user) {
                        return Comments::find()->where(['id_user' => $id_user, 'review' => 1])->count();
                    }],
                'genresView' => $genresView = function ($id) {
                    return Genres::getGenresFilm($id);
                },
                'averageRating' => function ($id) {
                    $temp = [];
                    foreach (Rating::find()->where(['id_film' => $id])->all() as $line) {
                        ;
                        array_push($temp, $line->num);
                    }
                    return $temp == null ? '?' : round(array_sum($temp) / count($temp), 1);
                },
                ]);
        }
    }

    public function actionClassFilm()
    {
        $model = new \app\models\Rating();
        $post = Yii::$app->request->post()['Films'];
        settype($post['num'], 'int');
        settype($post['id_film'], 'int');
        if ($model->id_user = Yii::$app->user->id) {
            $model->id_film = $post['id_film'];
            $model->num = $post['num'];
            $model->save();
            $this->redirect('view?id=' . $model->id_film);
        }
    }

    public function actionCommentAdd($id)
    {
        $model = new Comments();
        if ($model->load($post = Yii::$app->request->post())) {
            switch (isset($post['type'])) {
                case false: $model->type = 2; break;
                case true: $model->type = $post['type'];
            }
            switch (isset($post['review'])) {
                case false: $model->review = 0; break;
                case true: $model->review = $post['review'];
            }
            $model->date = date('Y-m-d');
            $model->id_film = $id;
            $model->id_user = Yii::$app->user->getId();
            $model->save();
            $this->redirect('view?id='.$id);
        }
        $this->redirect('view?id='.$id);
    }


    public function actionAddViewed($id)
    {
        $model = new \app\models\Viewed();
        $model->id_film = $id;
        $model->id_user = Yii::$app->user->id;
        if ($model->save()) {
            $this->redirect('view?id=' . $model->id_film);
        }
    }

    public function actionAddFavorites($id)
    {
        $model = new \app\models\Favorites();
        $model->id_film = $id;
        $model->id_user = Yii::$app->user->id;
        if ($model->save()) {
            $this->redirect('view?id=' . $model->id_film);
        }
    }

    public function actionDelViewed($id)
    {
        $model = new \app\models\Viewed();
        $model->find()->where(['id_film' => $id, 'id_user' => Yii::$app->user->id])->one()->delete();
        $this->redirect('view?id=' . $id);
    }

    public function actionDelFavorites($id)
    {
        $model = new \app\models\Favorites();
        $model->find()->where(['id_film' => $id, 'id_user' => Yii::$app->user->id])->one()->delete();
        $this->redirect('view?id=' . $id);
    }

    /**
     * Finds the Films model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Films the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Films::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
    public function init()
    {
        return (isset(Yii::$app->user->identity->id_role) and Yii::$app->user->identity->id_role  == 5 ) ?
            $this->redirect('/banned') : null;
    }
}
