<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Weather $model */
/** @var app\models\CheckPhotoImage $check_photo */
/** @var app\models\WeatherPhotoImage $weather_photo */

$this->title = 'Create Weather';
$this->params['breadcrumbs'][] = ['label' => 'Weather', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_create', [
        'model' => $model,
        'check_photo' => $check_photo,
        'weather_photo' => $weather_photo,
    ]) ?>

</div>