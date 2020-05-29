<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "films".
 *
 * @property int $id
 * @property string|null $title
 * @property string|null $description
 * @property int|null $genre
 * @property string|null $date
 * @property string|null $country
 * @property string|null $img
 * @property string|null $operator
 * @property string|null $screenwriter
 * @property string|null $producer
 *
 * @property Comments[] $comments
 * @property Favorites[] $favorites
 * @property Genre[] $genres
 * @property Rating[] $ratings
 * @property Viewed[] $vieweds
 */
class Films extends \yii\db\ActiveRecord
{
    public $num;
    public $genres;
    public $file;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'films';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'description', 'country', 'img', 'operator', 'screenwriter', 'producer'], 'string', 'min' => 2],
            [['file'], 'file', 'skipOnEmpty' => false, 'extensions' => ['jpg', 'png', 'jpeg']],
            [['genres'], 'required'],
            #[['genre'], 'integer'],
            [['date'], 'safe'],
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
            'description' => 'Описание',
            'genre' => 'Жанр',
            'date' => 'Дата выхода',
            'country' => 'Страна',
            'img' => 'Превью',
            'operator' => 'Оператор',
            'screenwriter' => 'Сценарист',
            'producer' => 'Продюсер',
            'genres' => 'Жанры'
        ];
    }



    /**
     * Gets query for [[Comments]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(Comments::className(), ['id_film' => 'id']);
    }

    /**
     * Gets query for [[Favorites]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFavorites()
    {
        return $this->hasMany(Favorites::className(), ['id_film' => 'id']);
    }

    /**
     * Gets query for [[Genres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGenres()
    {
        return $this->hasMany(Genre::className(), ['id_film' => 'id']);
    }

    /**
     * Gets query for [[Ratings]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRatings()
    {
        return $this->hasMany(Rating::className(), ['id_film' => 'id']);
    }

    /**
     * Gets query for [[Vieweds]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getVieweds()
    {
        return $this->hasMany(Viewed::className(), ['id_film' => 'id']);
    }
}
