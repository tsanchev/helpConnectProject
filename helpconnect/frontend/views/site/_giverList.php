<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $giverSearch backend\modules\giver\models\GiverSearch */
/* @var $giverDataProvider yii\data\ActiveDataProvider */

?>

<?= GridView::widget([
    'dataProvider' => $giverDataProvider,
    'filterModel' => $giverSearch,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        //'giver_id',
        //'user.username',
        'name',
        'company',
        'phone',
        'services:ntext',
    ],
]); ?>



