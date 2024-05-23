<div id="task">
    <div class="task-nav">
        <div class="nav-logo">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="3" y="3" width="8" height="8" rx="1" fill="currentColor"/>
                <rect x="13" y="3" width="8" height="8" rx="1" fill="currentColor"/>
                <rect x="3" y="13" width="8" height="8" rx="1" fill="currentColor"/>
                <rect x="13" y="13" width="8" height="8" rx="1" fill="currentColor"/>
            </svg>
        </div>
        <div class="nav-text">Выберите автомобиль</div>
    </div>
    <div class="task-menu">
        <div class="task-menu-item body-type-all" body-type="Все типы">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect x="3" y="3" width="8" height="8" rx="1" fill="currentColor"/>
                <rect x="13" y="3" width="8" height="8" rx="1" fill="currentColor"/>
                <rect x="3" y="13" width="8" height="8" rx="1" fill="currentColor"/>
                <rect x="13" y="13" width="8" height="8" rx="1" fill="currentColor"/>
            </svg>
    </div>
        <?php foreach ($viewVars['menuItems'] as $item): ?>
            <div class="task-menu-item body-type-<?= $item->getId() ?>" body-type="<?= $item->getName() ?>">
                <?= $item->getImage() ?>
            </div>
        <?php endforeach ?>
    </div>
    <div class="task-container-outer">
        <div class="task-container-inner">
            <div class="task-container-header">
                <div class="info-field" id="task-info-field">Все типы</div>
                <div class="close-button"></div>
            </div>
            <div class="task-container-body">
                <div class="task-container-content">
                        <div class="task-container-search">
                        <div type="task-search" >
                            <input type="text" id="task-search-input" class="task-search-input" placeholder="Поиск"/>
                        </div>
                        </div>
                    <div class="task-container-card-outer">
                        <div class="task-container-card-inner">
                        <?php foreach ($viewVars['cars'] as $car): ?>
                            <div class="task-card body-type-<?= $car->getBodyTypeId() ?>">
                                <div class="task-card-image">
                                    <img src="/uploads/images/<?= $car->getImage() ?>"/>
                                </div>
                                <div class="task-card-info">
                                    <span class="task-card-info-text">
                                        <?= $car->getBodyTypeName() ?> <?= $car->getMarkName() ?> <?= $car->getModelName() ?>
                                    </span>
                                    <img src="/icon/like.svg" class="task-card-info-like"/>
                                </div>
                            </div>
                        <?php endforeach ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>