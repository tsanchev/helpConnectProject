<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\seeker\models\Seeker */

$this->title = 'Актуализирай: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Търси помощ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->seeker_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="seeker-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
