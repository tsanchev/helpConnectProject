<?php

use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $seekerSearch backend\modules\seeker\models\SeekerSearch */
/* @var $seekerDataProvider yii\data\ActiveDataProvider */

?>

<?= GridView::widget([
    'dataProvider' => $seekerDataProvider,
    'filterModel' => $seekerSearch,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],

        //'seeker_id',
        //'user.username',
        'name',
        'phone',
        'workplace',
    ],
]); ?>



