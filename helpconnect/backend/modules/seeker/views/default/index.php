<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\seeker\models\SeekerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Търси помощ';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seeker-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'seeker_id',
            //'user.username',
            'name',
            'phone',
            'workplace',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
