<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\asset\models\Floor */

$this->title = 'Create Floor';
$this->params['breadcrumbs'][] = ['label' => 'Floor', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="floor-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
