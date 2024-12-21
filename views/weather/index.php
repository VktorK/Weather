<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'Weather list';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Weather list</h1>

        <table class="table table-hover">
                <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">Title</th>
                    <th scope="col">Price</th>
                    <th scope="col">Weather Photo</th>
                    <th scope="col">Check Photo</th>
                    <th scope="col">Date of buying</th>
                    <th scope="col">Date of end warranty</th>
                    <th scope="col">Update</th>
                    <th scope="col">Delete</th>
                </tr>
                </thead>
                <?php if(count($weathers) === 0) : ?>
                <?= Html::a('Нет сведений о товарах', ['create'], ['class' => 'btn btn-primary']) ?>
                <?php else: ?>
                <?php foreach ($weathers as $weather)  : ?>
                <tbody>
                <tr>
                    <td><?= $weather->id ?></td>
                    <td><?= $weather->title ?></td>
                    <td><?= $weather->price ?></td>
                    <td><?= is_null($weather->weather_photo) ? 'Фото товара не загружено' : $weather->weather_photo ?></td>
                    <td><?= is_null($weather->check_photo) ? 'Фото чека не загружено' : $weather->check_photo ?></td>
                    <td><?= is_null($weather->date_bying) ? 'Дата покупки не установлена' : $weather->date_bying ?></td>
                    <td><?= is_null($weather->date_end_warranty) ? 'Дата окончания гарантии не установлена' : $weather->date_end_warranty ?></td>
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
