<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\asset\models\RoomBooking */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Room Booking', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-booking-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Room Booking'.' '. Html::encode($this->title) ?></h2>
        </div>
        <div class="col-sm-3" style="margin-top: 15px">
            
            <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Are you sure you want to delete this item?',
                    'method' => 'post',
                ],
            ])
            ?>
        </div>
    </div>

    <div class="row">
<?php 
    $gridColumn = [
        ['attribute' => 'id', 'visible' => false],
        'booking_by',
        [
            'attribute' => 'room.name',
            'label' => 'Room',
        ],
        'date',
        'start_time',
        'end_time',
        'purpose',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>Room<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnRoom = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'floor_id',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->room,
        'attributes' => $gridColumnRoom    ]);
    ?>
</div>
