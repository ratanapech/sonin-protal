<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\asset\models\Building */

$this->title = 'Create Building';
$this->params['breadcrumbs'][] = ['label' => 'Building', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="building-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
