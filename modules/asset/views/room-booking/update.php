<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\modules\asset\models\RoomBooking */

$this->title = 'Update Room Booking: ' . ' ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Room Booking', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="room-booking-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
