<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var app\models\Weather $weather */

$this->title = $weather->title;
$this->params['breadcrumbs'][] = ['label' => 'Weather', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="articles-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Delete', ['destroy', 'id' => $weather->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $weather,
        'attributes' => [
            'id',
            'title',
            'price',
            'weather_photo',
            'check_photo',
            'date_bying',
            'date_end_warranty',
        ],
    ]) ?>

</div>
