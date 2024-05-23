<div class="row mb-3 g-2 justify-content-left">
    <div class="col-3">
        <form action="/task/task11" method="POST">
            <label for="timeEnd">Окончание выпуска</label>
            <input type="date" id="time-end"  name="time-end"
                value="<?= $viewVars['timeEnd']->format('Y-m-d') ?>"
                min="1990-01-01"
                max="" />
            <input class="mt-1" type="submit" value="Показать">
        </form>
    </div>
</div>

<div class="row g-2 justify-content-left">

<?php foreach($viewVars['cars'] as $car): ?>
    <div class="card col-4">
        <div class="card-header">
            <h4><?= $car->getMarkName() ?> <?= $car->getModelName() ?></h4>
        </div>
        <div class="card-body">
            <h6 class="card-title">
                Окончание выпуска
            </h6>
            <h5>
                <?= $car->getEndTime(true) ?>
            </h5>
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