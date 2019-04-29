<?php

namespace app\modules\asset\models\base;

use kartik\daterange\DateRangeBehavior;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\behaviors\BlameableBehavior;

/**
 * This is the base model class for table "room_booking".
 *
 * @property integer $id
 * @property string $booking_by
 * @property integer $room_id
 * @property string $date
 * @property string $start_time
 * @property string $end_time
 * @property string $purpose
 * @property string $created_at
 * @property integer $created_by
 * @property string $updated_at
 * @property integer $updated_by
 * @property string $deleted_at
 * @property integer $deleted_by
 * @property integer $lock
 *
 * @property \app\modules\asset\models\Room $room
 */
class RoomBooking extends \yii\db\ActiveRecord
{
    use \mootensai\relation\RelationTrait;

    private $_rt_softdelete;
    private $_rt_softrestore;

    public function __construct(){
        parent::__construct();
        $this->_rt_softdelete = [
            'deleted_by' => \Yii::$app->user->id,
            'deleted_at' => date('Y-m-d H:i:s'),
        ];
        $this->_rt_softrestore = [
            'deleted_by' => 0,
            'deleted_at' => date('Y-m-d H:i:s'),
        ];
    }

    /**
    * This function helps \mootensai\relation\RelationTrait runs faster
    * @return array relation names of this model
    */
    public function relationNames()
    {
        return [
            'room'
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
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
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ];
    }

    public function validateStartTime($attribute, $params, $validator)
    {
        $exist =  \app\modules\asset\models\RoomBooking::find()->where(['date' => $this->date])
            ->andWhere(['<=', 'start_time', $this->$attribute])
            ->andWhere(['>=', 'end_time', $this->$attribute])->select(['id'])->one();

        if ((!is_null($exist)) AND($exist != $this->id)){
            $this->addError($attribute, 'There is already a booking in that start time');
        }
    }

    public function validateTime($attribute, $params, $validator)
    {
        $exist_start_time  =  \app\modules\asset\models\RoomBooking::find()->where(['date' => $this->date])
            ->andWhere(['<=', 'start_time', $this->end_time])
            ->andWhere(['>=', 'start_time', $this->start_time])->select(['id'])->one();

        if($exist_start_time != $this->id){
            if (!is_null($exist_start_time)) {
                $this->addError($attribute, 'There is already a booking between that start and  end time');
            }
        }
    }

    public function validateEndTime($attribute, $params, $validator)
    {
        $exist_end_time  =  \app\modules\asset\models\RoomBooking::find()->where(['date' => $this->date])
            ->andWhere(['<=', 'start_time', $this->$attribute])
            ->andWhere(['>=', 'end_time', $this->$attribute])->select(['id'])->one();

        $exist_start_time  =  \app\modules\asset\models\RoomBooking::find()->where(['date' => $this->date])
            ->andWhere(['<=', 'start_time', $this->$attribute])
            ->andWhere(['>=', 'start_time', $this->start_time])->select(['id'])->one();

        if($exist_start_time != $this->id){

            if (!is_null($exist_end_time)) {
                    $this->addError($attribute, 'There is already a booking in that end time');
                }

            if (!is_null($exist_start_time)) {
                $this->addError($attribute, 'There is already a booking between that start and  end time');
            }
        }

    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'room_booking';
    }

    /**
     *
     * @return string
     * overwrite function optimisticLock
     * return string name of field are used to stored optimistic lock
     *
     */
    public function optimisticLock() {
        return 'lock';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'booking_by' => 'Booking By',
            'room_id' => 'Room Name',
            'date' => 'Date',
            'start_time' => 'Start Time',
            'end_time' => 'End Time',
            'purpose' => 'Purpose',
            'lock' => 'Lock',
        ];
    }
    
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRoom()
    {
        return $this->hasOne(\app\modules\asset\models\Room::className(), ['id' => 'room_id']);
    }
    
    /**
     * @inheritdoc
     * @return array mixed
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => 'updated_at',
                'value' => new \yii\db\Expression('NOW()'),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'created_by',
                'updatedByAttribute' => 'updated_by',
            ],
        ];
    }

    /**
     * The following code shows how to apply a default condition for all queries:
     *
     * ```php
     * class Customer extends ActiveRecord
     * {
     *     public static function find()
     *     {
     *         return parent::find()->where(['deleted' => false]);
     *     }
     * }
     *
     * // Use andWhere()/orWhere() to apply the default condition
     * // SELECT FROM customer WHERE `deleted`=:deleted AND age>30
     * $customers = Customer::find()->andWhere('age>30')->all();
     *
     * // Use where() to ignore the default condition
     * // SELECT FROM customer WHERE age>30
     * $customers = Customer::find()->where('age>30')->all();
     * ```
     */

    /**
     * @inheritdoc
     * @return \app\modules\asset\models\query\RoomBookingQuery the active query used by this AR class.
     */
    public static function find()
    {
        $query = new \app\modules\asset\models\query\RoomBookingQuery(get_called_class());
        return $query->where(['room_booking.deleted_by' => 0]);
    }
}
