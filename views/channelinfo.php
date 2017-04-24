<div class="wrapper">
    <div class="block-info-canal">
        <i class="fa fa-cogs te_first_block_header cat_about_channels max_<?= $data['about_channels']['first_block_header']['max_size'] ?>"
           aria-hidden="true"></i>
        <h3><?= $data['about_channels']['first_block_header']['code'] ?></h3>
        <p>
            <i class="fa fa-cogs te_first_block_text cat_about_channels max_<?= $data['about_channels']['first_block_text']['max_size'] ?>"
               aria-hidden="true"></i>
            <?= $data['about_channels']['first_block_text']['code'] ?>
        </p>
    </div>
    <div class="info-canal-img">
        <i class="fa fa-cogs im_second_block_img cat_about_channels max_<?= $data['about_channels']['second_block_img']['max_size'] ?>"
           aria-hidden="true"></i>
        <img src="/template/img/elements/<?= $data['about_channels']['second_block_img']['code'] ?>" alt="">
    </div>
    <div class="text-info-canal">
        <h4>
            <i class="fa fa-cogs te_third_block_header cat_about_channels max_<?= $data['about_channels']['third_block_header']['max_size'] ?>"
               aria-hidden="true"></i>
            <?= $data['about_channels']['third_block_header']['code'] ?>
        </h4>
        <p>
            <i class="fa fa-cogs te_third_block_text cat_about_channels max_<?= $data['about_channels']['third_block_text']['max_size'] ?>"
               aria-hidden="true"></i>
            <?= $data['about_channels']['third_block_text']['code'] ?>
        </p><br><br>
        <h4>
            Теперь непосредственно о создании канала Telegram
        </h4>
        <div class="left-canal">
            <p>
                1. Открыть Telegram<br>
                2. Выбрать “Создать канал”
            </p>
            <img src="/template/img/elements/img-can-1.png" alt="">
            <p>
                3. Придумываем его название и делаем описание<bR>
                (последнее необязательно)
            </p>
            <img src="/template/img/elements/img-can-2.png" alt="">
        </div>
        <div class="right-canal">
            <p>
                4. Выбираем тип канала - публичный или приватный.<br>
                Получаем URL этого канала для приглашения подписчиков
            </p>
            <img src="/template/img/elements/img-can-3.png" alt="">
            <p>
                5. В настройках можно сразу выбрать изображение<br>
                для своего канала
            </p>
            <img src="/template/img/elements/img-can-4.png" alt="">
            <p>
                6. При желании можно сразу добавить подписчиков из<br>
                своего списка контактов
            </p>
        </div>
        <div class="clear"></div>
    </div>
</div>
<div class="info-file-mass-2"
     style="background-image: url('/template/img/bg/<?= $data['about_channels']['fourth_block_background']['code'] ?>')">
    <div class="wrapper">
        <i class="fa fa-cogs im_fourth_block_background cat_about_channels max_<?= $data['about_channels']['fourth_block_background']['max_size'] ?>"
           aria-hidden="true"></i>
        <h3>
            <i class="fa fa-cogs te_fourth_block_header cat_about_channels max_<?= $data['about_channels']['fourth_block_header']['max_size'] ?>"
               aria-hidden="true"></i>
            <?= $data['about_channels']['fourth_block_header']['code'] ?>
        </h3>
        <p>
            <i class="fa fa-cogs te_fourth_block_subheader cat_about_channels max_<?= $data['about_channels']['fourth_block_subheader']['max_size'] ?>"
               aria-hidden="true"></i>
            <?= $data['about_channels']['fourth_block_subheader']['code'] ?>
        </p>
    </div>
</div>
