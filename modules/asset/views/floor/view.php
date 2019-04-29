<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $model app\modules\asset\models\Floor */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Floor', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="floor-view">

    <div class="row">
        <div class="col-sm-9">
            <h2><?= 'Floor'.' '. Html::encode($this->title) ?></h2>
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
            'attribute' => 'building.name',
            'label' => 'Building',
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
        <h4>Building<?= ' '. Html::encode($this->title) ?></h4>
    </div>
    <?php 
    $gridColumnBuilding = [
        ['attribute' => 'id', 'visible' => false],
        'name',
        'address',
        'company_id',
        ['attribute' => 'lock', 'visible' => false],
    ];
    echo DetailView::widget([
        'model' => $model->building,
        'attributes' => $gridColumnBuilding    ]);
    ?>
    
    <div class="row">
<?php
if($providerRoom->totalCount){
    $gridColumnRoom = [
        ['class' => 'yii\grid\SerialColumn'],
            ['attribute' => 'id', 'visible' => false],
            'name',
                        ['attribute' => 'lock', 'visible' => false],
    ];
    echo Gridview::widget([
        'dataProvider' => $providerRoom,
        'pjax' => true,
        'pjaxSettings' => ['options' => ['id' => 'kv-pjax-container-room']],
        'panel' => [
            'type' => GridView::TYPE_PRIMARY,
            'heading' => '<span class="glyphicon glyphicon-book"></span> ' . Html::encode('Room'),
        ],
        'export' => false,
        'columns' => $gridColumnRoom
    ]);
}
?>

    </div>
</div>
