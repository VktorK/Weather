<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\Weather $model */
/** @var app\models\CheckPhotoImage $check_photo */
/** @var app\models\WeatherPhotoImage $weather_photo */

$this->title = 'Update Weather';
$this->params['breadcrumbs'][] = ['label' => 'Weather', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="articles-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_update', [
        'model' => $model,

    ]) ?>

</div>