<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\GalleryType */

$this->title = 'Update Gallery Type: {nameAttribute}';
$this->params['breadcrumbs'][] = ['label' => 'Gallery Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="gallery-type-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
