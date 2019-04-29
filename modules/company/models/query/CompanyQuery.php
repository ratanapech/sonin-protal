<?php

namespace app\modules\company\models\query;

/**
 * This is the ActiveQuery class for [[\app\modules\company\models\query\Company]].
 *
 * @see \app\modules\company\models\query\Company
 */
class CompanyQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        $this->andWhere('[[status]]=1');
        return $this;
    }*/

    /**
     * @inheritdoc
     * @return \app\modules\company\models\query\Company[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return \app\modules\company\models\query\Company|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
