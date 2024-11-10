<?php


namespace app\models;


use yii\data\ActiveDataProvider;


class OfferSearch extends Offer
{
    public function rules()
    {
        return [
            [['name', 'email'], 'safe'],
        ];
    }

    public function search($params)
    {
        $query = Offer::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 10],
            'sort' => [
                'defaultOrder' => ['id' => SORT_ASC],
                'attributes' => ['id', 'name'],
            ],
        ]);

        $this->load($params);

        if (!($this->load($params) && $this->validate())) {
            return $dataProvider;
        }

        if ($this->name) {
            $query->andFilterWhere(['like', 'name', $this->name]);
        }
    
        if ($this->email) {
            $query->andFilterWhere(['like', 'email', $this->email]);
        }

        return $dataProvider;
    }
}
