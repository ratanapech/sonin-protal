<?php

namespace app\modules\asset\models\query;

/**
 * This is the ActiveQuery class for [[\app\modules\asset\models\query\Building]].
 *
 * @see \app\modules\asset\models\query\Building
 */
class BuildingQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\modules\asset\models\query\Building[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\asset\models\query\Building|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
