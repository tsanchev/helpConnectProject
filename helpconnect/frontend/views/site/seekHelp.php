<?php

/* @var $this yii\web\View */
/* @var $seeker backend\modules\seeker\models\Seeker */
/* @var $seekerRequestsDataProvider \yii\data\ActiveDataProvider */
/* @var $request \backend\modules\request\models\Request */

$this->title = 'Потърси помощ';


use yii\widgets\DetailView; ?>
<div class="site-seek-help">

    <h1 class="text-center"><?= $this->title ?></h1>

    <?php if( $seeker->seeker_id == 0): ?>

        <p><b>Твоите данни:</b></p>

        <?= $this->render('@backend/modules/seeker/views/default/_form', [
            'model' => $seeker,
        ]) ?>

    <?php else: ?>

        <p><b>Моят профил</b></p>

        <?= DetailView::widget([
            'model' => $seeker,
            'attributes' => [
                //'giver_id',
                //'user.username',
                'name',
                'phone',
                'workplace',
            ],
        ]) ?>
        <br>

        <p><b>Добави запитване</b></p>

        <?= $this->render('@backend/modules/request/views/default/_form', [
            'model' => $request,
        ]) ?>
    
        <p><b>Моите запитвания</b></p>
        <?= $this->render('_requestList', [
            'seekerRequestsDataProvider' => $seekerRequestsDataProvider,
        ]) ?>


    <?php endif; ?>


</div>
