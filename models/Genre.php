<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "genre".
 *
 * @property int $id
 * @property int|null $id_genres
 * @property int|null $id_film
 *
 * @property Films $film
 * @property Genres $genres
 */
class Genre extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'genre';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_genres', 'id_film'], 'integer'],
            [['id_film'], 'exist', 'skipOnError' => true, 'targetClass' => Films::className(), 'targetAttribute' => ['id_film' => 'id']],
            [['id_genres'], 'exist', 'skipOnError' => true, 'targetClass' => Genres::className(), 'targetAttribute' => ['id_genres' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'id_genres' => 'Id Genres',
            'id_film' => 'Id Film',
        ];
    }

    /**
     * Gets query for [[Film]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFilm()
    {
        return $this->hasOne(Films::className(), ['id' => 'id_film']);
    }

    /**
     * Gets query for [[Genres]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getGenres()
    {
        return $this->hasOne(Genres::className(), ['id' => 'id_genres']);
    }
}
