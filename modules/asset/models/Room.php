<?php

namespace app\modules\asset\models;

use Yii;
use \app\modules\asset\models\base\Room as BaseRoom;

/**
 * This is the model class for table "room".
 */
class Room extends BaseRoom
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['floor_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
