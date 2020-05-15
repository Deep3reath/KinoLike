<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "genres".
 *
 * @property int $id
 * @property string|null $title
 *
 * @property Genre[] $genres
 */
class Genres extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'genres';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Название',
        ];
    }

    /**
     * Gets query for [[Genres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGenres()
    {
        return $this->hasMany(Genre::className(), ['id_genres' => 'id']);
    }

    public function getGenresFilm($id_film)
    {
        $genre = new Genre();
        $genres = new Genres();
        $temp = [];
        foreach ($genre->find()->where(['id_film' => $id_film])->all() as $line) {
            array_push($temp, $genres->findOne(['id'=>$line->id_genres])->title);
        }
        return $temp;
    }

    public static function getGenresList($id_film = null)
    {
        $model = new Genres();
        return $model->find()
                ->all() ;
    }

}
