<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model common\models\GalleryType */

$this->title = 'Create Gallery Type';
$this->params['breadcrumbs'][] = ['label' => 'Gallery Types', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="gallery-type-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
