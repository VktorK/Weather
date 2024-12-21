<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Weather $weather */

$this->title = 'Create Weather';
$this->params['breadcrumbs'][] = ['label' => 'Weather', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_create', [
        'weather' => $weather,
    ]) ?>

</div>