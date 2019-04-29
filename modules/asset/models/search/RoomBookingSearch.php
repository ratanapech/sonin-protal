<?php

namespace app\modules\asset\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\modules\asset\models\RoomBooking;

/**
 * app\modules\asset\models\search\RoomBookingSearch represents the model behind the search form about `app\modules\asset\models\RoomBooking`.
 */
 class RoomBookingSearch extends RoomBooking
{
    /**
     * @inheritdoc
     */

     public $dateRange;
     public $date_min;
     public $date_max;

    public function rules()
    {
        return [
            [['date_min', 'date_max'], 'safe'],
            [['id', 'room_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['booking_by', 'date', 'start_time', 'end_time', 'purpose', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
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
        $query = RoomBooking::find();

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
            'id' => $this->id,
            'room_id' => $this->room_id,
            'date' => $this->date,
            'start_time' => $this->start_time,
            'end_time' => $this->end_time,
            'created_at' => $this->created_at,
            'created_by' => $this->created_by,
            'updated_at' => $this->updated_at,
            'updated_by' => $this->updated_by,
            'deleted_at' => $this->deleted_at,
            'deleted_by' => $this->deleted_by,
            'lock' => $this->lock,
        ]);

        $query->andFilterWhere(['like', 'booking_by', $this->booking_by])
            ->andFilterWhere(['like', 'purpose', $this->purpose])
            ->andFilterWhere(['>=', 'date', $this->date_min])
            ->andFilterWhere(['<=', 'date', $this->date_max]);

        return $dataProvider;
    }
}
