<?php

/* @var $this yii\web\View */
/* @var $searchModel app\modules\asset\models\search\RoomBookingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;

$this->title = 'Room Booking';
$this->params['breadcrumbs'][] = $this->title;
$search = "$('.search-button').click(function(){
	$('.search-form').toggle(1000);
	return false;
});";
$this->registerJs($search);
?>
<div class="room-booking-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    <?php 
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],
        [
            'class' => 'kartik\grid\ExpandRowColumn',
            'width' => '50px',
            'value' => function ($model, $key, $index, $column) {
                return GridView::ROW_COLLAPSED;
            },
            'detail' => function ($model, $key, $index, $column) {
                return Yii::$app->controller->renderPartial('_expand', ['model' => $model]);
            },
            'headerOptions' => ['class' => 'kartik-sheet-style'],
            'expandOneOnly' => true
        ],
        ['attribute' => 'id', 'visible' => false],
        'booking_by',
        [
                'attribute' => 'room_id',
                'label' => 'Room',
                'value' => function($model){
                    if ($model->room)
                    {return $model->room->name;}
                    else
                    {return NULL;}
                },
                'filterType' => GridView::FILTER_SELECT2,
                'filter' => \yii\helpers\ArrayHelper::map(\app\modules\asset\models\Room::find()->asArray()->all(), 'id', 'name'),
                'filterWidgetOptions' => [
                    'pluginOptions' => ['allowClear' => true],
                ],
                'filterInputOptions' => ['placeholder' => 'Room', 'id' => 'grid-room-booking-search-room_id']
            ],
        [
            'attribute' => 'date',
            'value' => 'date',
            'format' => 'raw',
            'filter' => kartik\daterange\DateRangePicker::widget([
                'model' => $searchModel,
                'attribute' => 'dateRange',
                'convertFormat'=>true,
                'startAttribute'=>'date_min',
                'endAttribute'=>'date_max',
                'pluginOptions'=>[
                    'timePicker'=>false,
                    'locale'=>[
                        'format'=>'Y-m-d'
                    ],
                    'cancel.daterangepicker'=>"function(ev, picker) {\$('#daterangeinput').val(''); // clear any inputs};"
                ]
            ]),


        ],
        'start_time',
        'end_time',
        'purpose',
        ['attribute' => 'lock', 'visible' => false],
    ];
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => false,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-room-booking']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        'export' => false,
    ]);
    ?>
</div>

<div class="form-group">
    <?= Html::a(Yii::t('app', 'Clear'), ['book'] , ['class'=> 'btn btn-danger']) ?>
</div>
