<?php

/** @var yii\web\View $this */
/** @var app\models\Weather $weathers */

use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Список товаров';
?>
<div class="site-index">
    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Список Товаров</h1>
        <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">Описание товара</th>
                    <th scope="col">Цена</th>
                    <th scope="col">Продавец</th>
                    <th scope="col">Фото товара</th>
                    <th scope="col">Фото чека</th>
                    <th scope="col">Дата покупки</th>
                    <th scope="col">Дата окончания гарантии</th>
                    <th scope="col">Обновить</th>
                    <th scope="col">Удалить</th>
                </tr>
                </thead>
                <tbody>
                <?php if(count($weathers) === 0) : ?>
                <?php else: ?>
                <?php foreach ($weathers as $weather)  : ?>
                <tr>
                    <td><?= $weather->title ?></td>
                    <td><?= $weather->price ?></td>
                    <td><?= $weather->seller ?></td>
                    <td><a href="<?= Url::toRoute(['weather/view','id'=>$weather->id]) ?>"><img src="<?=$weather->getWeatherImage()?>" alt = 'Фото товара' style="width: 200px; height: 200px;"></a></td>
                    <td><a href="<?= Url::toRoute(['weather/view','id'=>$weather->id]) ?>"><img src="<?=$weather->getCheckImage()?>"  alt = 'Фото чека' style="width: 200px; height: 200px;"</a></td>
                    <td><?= is_null($weather->date_bying) ? 'Дата покупки не установлена' : Yii::$app->formatter->asDate($weather->date_bying, 'php:d-m-Y') ?></td>
                    <td><?= is_null($weather->date_end_warranty) ? 'Дата окончания гарантии не установлена' : Yii::$app->formatter->asDate($weather->date_end_warranty, 'php:d-m-Y') ?></td>
                        <td><?= Html::a('Обновить', ['update', 'id' => $weather->id], ['class' => 'btn btn-primary'])?></td>
                        <td><?= Html::a('Удалить', ['destroy', 'id' => $weather->id], [
                                'class' => 'btn btn-danger',
                                'data' => [
                                    'confirm' => 'Are you sure you want to delete this item?',
                                    'method' => 'post',
                                ],
                            ]) ?></td>
                </tr>
                </tbody>
        </table>
        <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
