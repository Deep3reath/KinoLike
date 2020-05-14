<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Films;

/**
 * FilmsSearch represents the model behind the search form of `app\models\Films`.
 */
class FilmsSearch extends Films
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'description', 'date', 'country', 'img', 'operator', 'screenwriter', 'producer', 'genres.genres.title'], 'safe'],
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
        $query = Films::find();
        $query->joinWith('genres');
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
        $dataProvider->sort->attributes['genres.genres.title'] = [
            'asc' => [Genre::tableName() . '.title' => SORT_ASC],
            'desc' => [Genre::tableName() . '.title' => SORT_DESC],
        ];

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'date' => $this->date,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'country', $this->country])
            ->andFilterWhere(['like', 'img', $this->img])
            ->andFilterWhere(['like', 'operator', $this->operator])
            ->andFilterWhere(['like', 'screenwriter', $this->screenwriter])
            ->andFilterWhere(['like', 'producer', $this->producer])
            ->andFilterWhere(['like', Genre::tableName().'.title', $this->getAttribute('genres.genres.title')]);

        return $dataProvider;
    }
    public function attributes()
    {
        // делаем поле зависимости доступным для поиска
        return array_merge(parent::attributes(), [
            'genres.genres.title'
        ]);
    }
}
