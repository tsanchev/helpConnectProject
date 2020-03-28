<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\request\models\Request */

$this->title = 'Актуализирай: ' . $model->request_id;
$this->params['breadcrumbs'][] = ['label' => 'Запитвания', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->request_id, 'url' => ['view', 'id' => $model->request_id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="request-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
