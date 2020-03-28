<?php

use backend\modules\item\models\Item;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\modules\request\models\Request */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="request-form">

    <?php $form = ActiveForm::begin(); ?>

    <?php // $form->field($model, 'seeker_id')->textInput() ?>

    <?= $form->field($model, 'request')->textarea(['rows' => 6]) ?>

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
