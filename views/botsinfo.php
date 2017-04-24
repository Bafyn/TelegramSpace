<div class="wrapper">
    <i class="fa fa-cogs im_first_block_background cat_about_bots max_<?= $data['about_bots']['first_block_background']['max_size'] ?>"
       aria-hidden="true"></i>
    <div class="slider-block-bots"
         style="background-image: url('/template/img/elements/<?= $data['about_bots']['first_block_background']['code'] ?>')">
    </div>
    <div class="block-info-bots">
        <h3>
            <i class="fa fa-cogs te_second_block_header cat_about_bots max_<?= $data['about_bots']['second_block_header']['max_size'] ?>"
               aria-hidden="true"></i>
            <?= $data['about_bots']['second_block_header']['code'] ?>
        </h3>
        <p>
            <i class="fa fa-cogs te_second_block_first_text cat_about_bots max_<?= $data['about_bots']['second_block_first_text']['max_size'] ?>"
               aria-hidden="true"></i>
            <?= $data['about_bots']['second_block_first_text']['code'] ?>
        </p><br><br>
        <h4>
            <i class="fa fa-cogs te_second_block_subheader cat_about_bots max_<?= $data['about_bots']['second_block_subheader']['max_size'] ?>"
               aria-hidden="true"></i>
            <?= $data['about_bots']['second_block_subheader']['code'] ?>
        </h4>
        <p>
            <i class="fa fa-cogs te_second_block_second_text cat_about_bots max_<?= $data['about_bots']['second_block_second_text']['max_size'] ?>"
               aria-hidden="true"></i>
            <?= $data['about_bots']['second_block_second_text']['code'] ?>
        </p>
        <div class="img-bots">
            <i class="fa fa-cogs im_third_block_img cat_about_bots max_<?= $data['about_bots']['third_block_img']['max_size'] ?>"
               aria-hidden="true"></i>
            <img src="/template/img/elements/<?= $data['about_bots']['third_block_img']['code'] ?>" alt="">
        </div>
        <h3>
            <i class="fa fa-cogs te_fourth_block_header cat_about_bots max_<?= $data['about_bots']['fourth_block_header']['max_size'] ?>"
               aria-hidden="true"></i>
            <?= $data['about_bots']['fourth_block_header']['code'] ?>
        </h3>
        <p>
            <i class="fa fa-cogs te_fourth_block_text cat_about_bots max_<?= $data['about_bots']['fourth_block_text']['max_size'] ?>"
               aria-hidden="true"></i>
            <?= $data['about_bots']['fourth_block_text']['code'] ?>
        </p>
        <h3 class="custom-title-bots">
            Как пользоваться ботами
        </h3>
        <h4>
            Алгоритм следующий
        </h4>
        <p>
            1. Находим нужного бота (например, в каталоге)и переходим к нему по прямой ссылке или через поиск.
        </p>
        <p>
            2. Вступаем с ним в общение. Для этого необходимо нажать кнопку Start, которая находится на его странице или
            набрать
            команду <span class="blue-color">/start</span> .
        </p>
        <p>
            3. По этой команде бот пришлет вам подробное описание своих возможностей и инструкцию по взаимодействию с
            ним со всеми командами (возможен вывод виртуальных кнопок-команд на экран).
        </p>
        <div class="img-bots">
            <img src="/template/img/elements/bots-2.png" alt="">
        </div>
        <div class="bottom-bots-info">
            <div class="left-block-bots">
                <img src="/template/img/elements/bots-3.png" alt="">
            </div>
            <div class="right-block-bots">
                <h3>
                    Можно ли самому создать бот
                </h3>
                <h4>
                    Можно и даже без знаний программирования.
                </h4>
                <p>
                    Telegram предоставляет на своем сайте подробную инструкцию, правда на английском языке. Также
                    имеется бот <span class="color-bir">@BotFather</span> , то есть отец всех ботов, который поможет в
                    рождении нового бота и выдаст уникальный ключ-идентификатор. Так что, если разобраться, ничего
                    сложного нет. Примерно, как создавать сайт при помощи конструктора.
                </p>
            </div>
            <div class="clear"></div>
            <a href="/bot/list">
                Перейти в каталог ботов
            </a>
        </div>
    </div>
</div>