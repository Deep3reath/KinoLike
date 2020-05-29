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
use yii\data\ActiveDataProvider;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;


class SearchController extends Controller
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
        if(($post = Yii::$app->request->post('search'))) {
            $query = Films::find()->where(['title' => $post])->orderBy('id DESC');
            $dataProvider = new ActiveDataProvider([
                'query' => $query,
                'pagination' => [
                    'pageSize' => 7,
                    'totalCount' => FilmsSearch::find()->orderBy('id DESC')->count()
                ],
            ]);

            return $this->render('index',
                [
                    'dataProvider' => $dataProvider,
                    'response' => $post,
                    'filmsCount' => Films::find()->count(),
                ]);
        }
        return $this->redirect('/film-page');
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

}
