<?php

/* @var $this yii\web\View */
/* @var $seeker backend\modules\seeker\models\Seeker */
/* @var $giverSearch backend\modules\giver\models\GiverSearch */
/* @var $giverDataProvider yii\data\ActiveDataProvider */

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
                'necessities:ntext',
            ],
        ]) ?>
        <br>

        <p><b>Списък предлагащи помощ</b></p>

        <?= $this->render('_giverList', [
            'giverSearch' => $giverSearch,
            'giverDataProvider' => $giverDataProvider,
        ]) ?>

    <?php endif; ?>


</div>
