<?php

/* @var $this yii\web\View */
/* @var $searchModel app\modules\asset\models\search\RoomBookingSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

use yii\helpers\Html;
use kartik\export\ExportMenu;
use kartik\grid\GridView;
use yii\widgets\ActiveForm;

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


    <div class="room-booking-form">

        <?php $form = ActiveForm::begin(); ?>

        <div class="row">
            <div class="col-sm-4">
                <?= $form->field($model, 'booking_by')->textInput(['maxlength' => true, 'placeholder' => 'Booking By']) ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'room_id')->widget(\kartik\widgets\Select2::classname(), [
                    'data' => \yii\helpers\ArrayHelper::map(\app\modules\asset\models\Room::find()->orderBy('id')->asArray()->all(), 'id', 'name'),
                    'options' => ['placeholder' => 'Choose Room'],
                    'pluginOptions' => [
                        'allowClear' => true
                    ],
                ]); ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'date')->widget(\kartik\datecontrol\DateControl::classname(), [
                    'type' => \kartik\datecontrol\DateControl::FORMAT_DATE,
                    'saveFormat' => 'php:Y-m-d',
                    'ajaxConversion' => true,
                    'options' => [
                        'pluginOptions' => [
                            'placeholder' => 'Choose Date',
                            'autoclose' => true
                        ]
                    ],
                ]); ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'start_time')->widget(\kartik\datecontrol\DateControl::className(), [
                    'type' => \kartik\datecontrol\DateControl::FORMAT_TIME,
                    'saveFormat' => 'php:H:i:s',
                    'ajaxConversion' => true,
                    'options' => [
                        'pluginOptions' => [
                            'placeholder' => 'Choose Start Time',
                            'autoclose' => true
                        ]
                    ]
                ]); ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'end_time')->widget(\kartik\datecontrol\DateControl::className(), [
                    'type' => \kartik\datecontrol\DateControl::FORMAT_TIME,
                    'saveFormat' => 'php:H:i:s',
                    'ajaxConversion' => true,
                    'options' => [
                        'pluginOptions' => [
                            'placeholder' => 'Choose End Time',
                            'autoclose' => true
                        ]
                    ]
                ]); ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'purpose')->textInput(['maxlength' => true, 'placeholder' => 'Purpose']) ?>
            </div>
        </div>

        <?= $form->errorSummary($model); ?>

        <?= $form->field($model, 'id', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>


        <?= $form->field($model, 'lock', ['template' => '{input}'])->textInput(['style' => 'display:none']); ?>

        <div class="form-group">
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

    <?php
    $gridColumn = [
        ['class' => 'yii\grid\SerialColumn'],

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
        'date',
        'start_time',
        'end_time',
        'purpose',
        ['attribute' => 'lock', 'visible' => false],
        [
            'class' => 'yii\grid\ActionColumn',
        ],
    ];
    ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => $gridColumn,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-room-booking']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span>  ' . Html::encode($this->title),
        ],
        'export' => false,
        // your toolbar can include the additional full export menu
        'toolbar' => [
            '{export}',
            ExportMenu::widget([
                'dataProvider' => $dataProvider,
                'columns' => $gridColumn,
                'target' => ExportMenu::TARGET_BLANK,
                'fontAwesome' => true,
                'dropdownOptions' => [
                    'label' => 'Full',
                    'class' => 'btn btn-default',
                    'itemsBefore' => [
                        '<li class="dropdown-header">Export All Data</li>',
                    ],
                ],
                'exportConfig' => [
                    ExportMenu::FORMAT_PDF => false
                ]
            ]) ,
        ],
    ]); ?>

</div>
<div class="form-group">
    <?= Html::a(Yii::t('app', 'Clear'), ['room_booking'] , ['class'=> 'btn btn-danger']) ?>
</div>
