<?php

namespace app\modules\asset\models;

use Yii;
use \app\modules\asset\models\base\Floor as BaseFloor;

/**
 * This is the model class for table "floor".
 */
class Floor extends BaseFloor
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['building_id', 'created_by', 'updated_by', 'deleted_by', 'lock'], 'integer'],
            [['created_at', 'updated_at', 'deleted_at'], 'safe'],
            [['name'], 'string', 'max' => 50],
            [['lock'], 'default', 'value' => '0'],
            [['lock'], 'mootensai\components\OptimisticLockValidator']
        ]);
    }
	
}
