<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Images */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="images-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'gallery_id')->textInput() ?>

    <?= $form->field($model, 'imagename')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
