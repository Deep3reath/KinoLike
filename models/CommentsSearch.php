<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Comments;

/**
 * CommentsSearch represents the model behind the search form of `app\models\Comments`.
 */
class CommentsSearch extends Comments
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'review', 'id_user', 'id_film'], 'integer'],
            [['text', 'date', 'user.username', 'film.title'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Comments::find();
        $query->joinWith('user');
        $query->joinWith('film');
        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $dataProvider->sort->attributes['user.username'] = [
            'asc' => [User::tableName() . '.username' => SORT_ASC],
            'desc' => [User::tableName() . '.username' => SORT_DESC],
        ];

        $dataProvider->sort->attributes['film.title'] = [
            'asc' => [Films::tableName() . '.title' => SORT_ASC],
            'desc' => [Films::tableName() . '.title' => SORT_DESC],
        ];


        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
            'review' => $this->review,
            'id_user' => $this->id_user,
            'id_film' => $this->id_film,])
            ->andFilterWhere(['like', User::tableName().'.username', $this->getAttribute('user.username')])
            ->andFilterWhere(['like', Films::tableName().'.title', $this->getAttribute('film.title')]);

        $query->andFilterWhere(['like', 'text', $this->text]);

        return $dataProvider;
    }
    public function attributes()
    {
        // делаем поле зависимости доступным для поиска
        return array_merge(parent::attributes(), [
            'user.username',
            'film.title',
        ]);
    }
}
