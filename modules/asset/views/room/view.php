<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\asset\models\Room */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Room', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="room-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Room'.' '. Html::encode($this->title) ?></h2>
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
        'name',
        [
            'attribute' => 'floor.name',
            'label' => 'Floor',
        ],
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model,
        'attributes' => $gridColumn
    ]);
?>
    </div>
    <div class="row">
        <h4>Floor<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnFloor = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'building_id',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->floor,
        'attributes' => $gridColumnFloor    ]);
    ?>
    
    <div class="row">
<?php
if($providerRoomBooking->totalCount){
    $gridColumnRoomBooking = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            'booking_by',
                        'date',
            'start_time',
            'end_time',
            'purpose',
            ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerRoomBooking,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-room-booking']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Room Booking'),
        ],
        'export' => false,
        'columns' => $gridColumnRoomBooking
    ]);
}
?>

    </div>
</div>
