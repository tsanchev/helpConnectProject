<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\modules\seeker\models\Seeker */

$this->title = 'Създай';
$this->params['breadcrumbs'][] = ['label' => 'Търси помощ', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="seeker-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
