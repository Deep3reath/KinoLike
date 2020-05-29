<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "comments".
 *
 * @property int $id
 * @property string|null $text
 * @property string|null $date
 * @property int|null $review
 * @property int|null $id_user
 * @property int|null $id_film
 * @property int|null $type
 *
 * @property Films $film
 * @property User $user
 */
class Comments extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'comments';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['review', 'type', 'text'], 'required'],
            [['date'], 'safe'],
            [['review', 'id_user', 'id_film'], 'integer'],
            [['text'], 'string', 'max' => 127],
            [['id_film'], 'exist', 'skipOnError' => true, 'targetClass' => Films::className(), 'targetAttribute' => ['id_film' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'text' => 'Текст',
            'date' => 'Дата',
            'review' => 'Тип',
            'id_user' => 'Пользователь',
            'id_film' => 'Фильм ',
            'type' => 'Мнение',
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
