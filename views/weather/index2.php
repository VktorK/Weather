<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Weather';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-index">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="weather-search">

        <?php $form = ActiveForm::begin([
            'method' => 'get',
            'action' => ['index'],
        ]); ?>

        <?= $form->field($searchModel, 'title') ?>
        <?= $form->field($searchModel, 'seller') ?>
        <?= $form->field($searchModel, 'date_end_warranty') ?>
        <?= $form->field($searchModel, 'created_at') ?>

        <div class="form-group">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'title',
            'seller',
            'weather_photo',
            'check_photo',
            'date_end_warranty',
            'created_at',
            // Другие колонки

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>