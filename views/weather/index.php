<?php

/** @var yii\web\View $this */

$this->title = 'Weather list';
?>
<div class="site-index">

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Weather list</h1>
        <?php foreach ($weathers as $weather)  : ?>
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
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td><?= $weather->id ?></td>
                    <td><?= $weather->title ?></td>
                    <td><?= $weather->price ?></td>
                    <td><?= is_null($weather->weather_photo) ? 'Фото товара не загружено' : $weather->weather_photo ?></td>
                    <td><?= is_null($weather->check_photo) ? 'Фото чека не загружено' : $weather->check_photo ?></td>
                    <td><?= is_null($weather->date_bying) ? 'Дата покупки неизвестна' : $weather->date_bying ?></td>
                    <td><?= is_null($weather->date_end_warranty) ? 'Дата окончания гарантии неизвестна' : $weather->date_end_warranty ?></td>

                </tr>

                </tbody>
        </table>
        <?php endforeach; ?>
    </div>

</div>
