<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use common\models\GalleryType;
use app\assets\StatusAsset;
use kartik\file\FileInput;

/* @var $this yii\web\View */
/* @var $model common\models\Users */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="users-form">

    <?php 
      $form = ActiveForm::begin([
          'options'=>['enctype'=>'multipart/form-data']]); // important         
    ?>

    <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>
    <?php //echo $form->dropDownList($model,'item_type_id', CHtml::GallerTypey(GallerTypey::model()->findAll(), 'id', 'gallery_type_name'), array('empty'=>'select Gallery Type')); ?>

    <?php $gallery_type_name = ArrayHelper::map(\common\models\GalleryType::find()->orderBy('gallery_type_name')->all(), 'id', 'gallery_type_name') ?>
	<?= $form->field($model, 'gallery_type_id')->dropDownList($gallery_type_name, ['prompt' => '---- Select Gallery Type ----'])->label('Gallery type') ?>

	<?= $form->field($model, 'image1')->widget(FileInput::classname(), [
              'options' => ['accept' => 'image/*'],
               'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png'],'showUpload' => false,],
          ]);   ?>
    <?= $form->field($model, 'image2')->widget(FileInput::classname(), [
              'options' => ['accept' => 'image/*'],
               'pluginOptions'=>['allowedFileExtensions'=>['jpg','gif','png'],'showUpload' => false,],
          ]);   ?>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
