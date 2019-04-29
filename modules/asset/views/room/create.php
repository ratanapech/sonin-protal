<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\modules\asset\models\Room */

$this->title = 'Create Room';
$this->params['breadcrumbs'][] = ['label' => 'Room', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
