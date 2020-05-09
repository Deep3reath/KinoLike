<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "viewed".
 *
 * @property int $id
 * @property int|null $id_user
 * @property int|null $id_film
 *
 * @property Films $film
 * @property User $user
 */
class Viewed extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'viewed';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_user', 'id_film'], 'integer'],
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
            'id_user' => 'Id User',
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
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
