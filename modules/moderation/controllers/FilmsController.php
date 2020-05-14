<?php

namespace app\modules\moderation\controllers;

use app\models\Genre;
use app\models\Genres;
use Yii;
use app\models\Films;
use app\models\FilmsSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * FilmsController implements the CRUD actions for Films model.
 */
class FilmsController extends Controller
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
            'genres' => new Genres(),
            'films' => function($id) {
            return $this->findModel($id);
            },
            'genre' => new Genre(),
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
        return $this->render('view', [
            'model' => $this->findModel($id),
            'films' => new Films(),
            'genres' => new Genres(),
        ]);
    }

    /**
     * Creates a new Films model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     * @throws \yii\db\Exception
     */

    public function actionCreate()
    {
        $film = new Films;
        $genres = new Genre;
        if ($film->load($response = Yii::$app->request->post())) {
            $film->file = UploadedFile::getInstance($film, 'file');
            $idImg = mt_rand(1, 1000);
            $film->img = 'upload/films/' . $idImg . md5($film->file->name) . '.' . $film->file->extension;
            $film->save();
            foreach ($response['Films']['genres'] as $genre):
                Yii::$app->db->createCommand()->insert('genre', [
                    'id_film' => $film->id,
                    'id_genres' => $genre,
                ])->execute();
            endforeach;

            if (!empty($film->file)) {
                $film->file->saveAs("upload/films/" . $idImg . md5($film->file->name) . '.' . $film->file->extension);
            }
            return $this->redirect('view?id='.$film->id);
        }
        return $this->render('create', [
            'model' => $film,
            'genres' => new Genres()
        ]);
    }

    /**
     * Updates an existing Films model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     * @throws \yii\db\Exception
     * @throws \Throwable
     */
    public function actionUpdate($id)
    {
        $film = $this->findModel($id);
        if ($film->load($response = (Yii::$app->request->post()))) {
            var_dump(Yii::$app->db->createCommand()->delete('genre', [
                'id_film' => $film->id,
            ])->execute());
            $film->file = UploadedFile::getInstance($film, 'file');
            $idImg = mt_rand(1, 1000);
            $film->img = 'upload/films/' .$idImg . md5($film->file->name) . '.' .$film->file->extension;
            $film->save();
            if(!empty($film->file))
                $film->file->saveAs($film->img);
            foreach ($response['Films']['genres'] as $genre):
                Yii::$app->db->createCommand()->insert('genre', [
                    'id_film' => $film->id,
                    'id_genres' => $genre,
                ])->execute();
            endforeach;
            return $this->redirect(['view', 'id' => $film->id]);
        }

        return $this->render('update', [
            'model' => $film,
            'genres' => new Genres(),
        ]);
    }

    /**
     * Deletes an existing Films model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
