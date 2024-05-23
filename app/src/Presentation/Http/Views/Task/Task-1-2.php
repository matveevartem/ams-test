<div class="row mb-3 g-2 justify-content-left">
    <form action="/task/task12" method="POST">
        <label>Минимальная стоимость</label>
        <input type="number" name="summ" value="<?= $viewVars['filterSumm'] ?>"/>
        <input type="submit" value="Показать">
    </form>
</div>
<div class="row g-2 justify-content-left">

<?php foreach($viewVars['cars'] as $car): ?>
    <div class="card col-4">
        <div class="card-header">
            <h4>
                <?= $car->getMarkName() ?> <?= $car->getModelName() ?>
            </h4>
        </div>
        <div class="card-body">
            <h5><?= $car->getWorkName() ?></h5>
            <p class="card-title"><i>Стоимость:</i> <?= $car->getWorkCost(true) ?></p>
            <p class="card-title"><i>Время работ:</i> <?= $car->getWorkTime(true) ?> час.</p>
            <button
                class="btn btn-primary btn-car-info"
                type="button"
                id="btn-car-info-<?= $car->getModelId() ?>",
                data-bs-toggle="modal"
                data-bs-target="#carModal">Полная информация о модели</button>
        </div>
    </div>
    <?php endforeach ?>

</div>