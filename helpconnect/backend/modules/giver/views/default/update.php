<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\giver\models\Giver */

$this->title = 'Актуализирай: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Предалага помощ', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->giver_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="giver-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
