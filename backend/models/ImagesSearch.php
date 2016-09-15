<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Images;

/**
 * ImagesSearch represents the model behind the search form about `backend\models\Images`.
 */
class ImagesSearch extends Images
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_id', 'counter', 'deleted'], 'integer'],
            [['path', 'created', 'last', 'album_id'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Images::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        $query->joinWith('album');

        $query->andFilterWhere([
            'image_id' => $this->image_id,
            'counter' => $this->counter,
            'created' => $this->created,
            'last' => $this->last,
            'deleted' => 0,

        ]);

        $query->andFilterWhere(['like', 'path', $this->path])
        ->andFilterWhere(['like','album.name', $this->album_id]);


        return $dataProvider;
    }
}
