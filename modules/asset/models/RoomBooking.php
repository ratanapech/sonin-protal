<?php

namespace app\modules\asset\models;

use Yii;
use \app\modules\asset\models\base\RoomBooking as BaseRoomBooking;

/**
 * This is the model class for table "room_booking".
 */
class RoomBooking extends BaseRoomBooking
{
    /**
     * @inheritdoc
     */
    public $dateRange;
    public $date_min;
    public $date_max;

    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['date_min', 'date_max'], 'safe'],
            [['start_time'], 'validateStartTime'],
            [['end_time'], 'validateEndTime'],
            [['end_time','start_time'], 'validateTime'],
            [['end_time'], 'compare', 'compareAttribute' => 'start_time', 'operator' => '>'],
            [['id', 'room_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['date', 'created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['booking_by'], 'string', 'max' => 50],
            [['purpose'], 'string', 'max' => 100],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator'],
            [['booking_by', 'room_id', 'date', 'start_time', 'end_time', 'purpose'], 'required'],
        ]);
    }
	
}
