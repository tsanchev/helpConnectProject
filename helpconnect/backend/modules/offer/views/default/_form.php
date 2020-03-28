<?php

use backend\modules\item\models\Item;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\offer\models\Offer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="offer-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->field($model, 'giver_id')->textInput() ?>

    <?= $form->field($model, 'offer')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'items')->widget(Select2::classname(), [
        'data' => Item::getItems(),
        'options' => ['placeholder' => Yii::t('app', 'Добави артикули ...'),],
        'pluginOptions' => [
            'allowClear' => true,
            'multiple' => true,
            'tags' => true,
        ],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Добави', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
