<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\giver\models\GiverSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Предалага помощ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="giver-index">

    <h1><?= Html::encode($this->title) ?></h1>


    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'giver_id',
            //'user.username',
            'name',
            'company',
            'phone',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
