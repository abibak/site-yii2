<?php

/* @var $this yii\web\View */

$this->title = 'Главная';

$date = date("Y-m-d");
$last_day = date('Y-m-t');
?>
<!-- general information section -->

<div class="modal-record">
    <div class="record-online">
        <span>Запись онлайн <i class="fas fa-times close-modal"></i></span>
    </div>

    <div class="content-modal">
        <p class="text-employee">Выбранный сотрудник</p>
        <div class="selected-master"></div>

        <div class="employee-selection">
            <p class="open-employees">Выберите сотрудника <i class="fas fa-chevron-down"></i></p>

            <div class="block-masters">
                <?php foreach ($employees as $employee): ?>

                    <div class="master" data-master-id="<?= $employee['id'] ?>"
                         data-master-name="<?= $employee['name'] ?>">
                        <span class="name-master"><?= $employee['name'] . ' ' . $employee['surname'] ?></span>
                        <span class="prof">Мастер</span>
                    </div>

                <?php endforeach; ?>
            </div>
        </div>

        <p class="selected-services">Выбранные услуги</p>
        <div class="list-select"></div>

        <p class="open-list">EREN STYLE услуги <i class="fas fa-chevron-down"></i></p>
        <div class="container-services">

            <?php print_r($services); foreach ($services as $service): ?>

                <div class="service-card">
                    <i class="far fa-circle" data-service-id="<?= $service['id'] ?>">
                        <span class="name-service"><?= $service['name'] ?></span>
                        <span class="price-service"><?= $service['price'] ?></span>
                        <span class="time"><?= $service['work_time'] ?></span>
                    </i>
                </div>

            <?php endforeach; ?>

        </div>

        <div class="date-picker">
            <label for="date">Выберите дату</label>
            <input type="date" id="date" name="date-record" min="<?= $date ?>" max="<?= $last_day ?>">
        </div>

        <div class="timing">
            <p>Выберите время</p>
            <div class="block-time">
            </div>
        </div>

        <button class="model-btn-record">Записаться</button>
    </div>

    <div class="result-sum">
        <span>Выбрано (<span class="number">0</span>)</span>
        <span><span class="sum">0</span> Р. </span>
        <span class="selected-time">Время: <span class="result-time-show"></span></span>
    </div>
</div>

<div>
    <div class="container section-content">
        <div class="container-info">
            <p class="title">EREN STYLE BARBERSHOP в Томске</p>

            <div class="description">Наш парикмахерский салон стремится предоставить нашим клиентам лучший опыт
                парикмахерского
                искусства. Мы - творческая команда специалистов по парикмахерскому искусству, обладающих обширным опытом
                в
                области профессионального ухода за волосами.
            </div>

            <!-- list service -->
            <div class="container-record-service">
                <div class="list-service">
                    <p class="name-service">Мужская стрижка <span class="price-service">до 300 Р.</span></p>
                    <p class="name-service">Женская стрижка <span class="price-service">до 400 Р.</span></p>
                    <p class="name-service">Детская стрижка <span class="price-service">до 200 Р.</span></p>
                    <p class="name-service">Стрижка Бороды / Усов <span class="price-service">100 Р.</span></p>
                    <p class="name-service">Укладка волос <span class="price-service">от 500 Р.</span></p>
                </div>

                <div class="record-btn">
                    <a id="link-record" href="#">Онлайн запись</a>
                </div>
            </div>
        </div>
    </div>
</div>
