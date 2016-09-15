<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\UserImage;

/**
 * UserImageSearch represents the model behind the search form about `backend\models\UserImage`.
 */
class UserImageSearch extends UserImage
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'image_id'], 'integer'],
            [['last_view'], 'safe'],
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
        $query = UserImage::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'user_id' => $this->user_id,
            'image_id' => $this->image_id,
            'last_view' => $this->last_view,
        ]);

        return $dataProvider;
    }
}
