<?php require_once(ROOT . '/views/layouts/header.php'); ?>

<div class="modalAddBot">
    <div class="contentCanalAdd">
        <div class="btn-close"></div>
        <h3><span class="line-title"></span> Предложить бота</h3>
        <form method="post">
            <input type="hidden" name="secret_offer_bot" value="<?= rand(); ?>"/>
            <label class="label-2">
                Ссылка на бота<span class="obligatory_field">*</span>:<br>
                <input type="text" required maxlength="100" name="bot_link" placeholder="https://t.me/"
                       value="<?= isset($data['link']) ? $data['link'] : 'https://t.me/' ?>" style="width: 100%;"
                       class="inp-form">
            </label>
            <label class="label-2">
                Username бота<span class="obligatory_field">*</span>:<br>
                <input type="text" required maxlength="90" name="bot_username" placeholder="Username бота"
                       value="<?= isset($data['username']) ? $data['username'] : "" ?>" style="width: 100%;"
                       class="inp-form">
            </label>
            <label class="label-2">
                Название<span class="obligatory_field">*</span>:<br>
                <input type="text" required maxlength="50" name="bot_title" style="width: 100%;"
                       placeholder="Название бота"
                       value="<?= isset($data['title']) ? $data['title'] : "" ?>" class="inp-form" />
            </label>
            <label class="label-2">
                Описание<span class="obligatory_field">*</span>:<br>
                <textarea name="bot_description" required maxlength="200"
                          placeholder="Описание бота"><?= isset($data['description']) ? $data['description'] : "" ?></textarea>
            </label>
            <label class="label-2">
                Дополнительная информация:<br>
                <textarea name="bot_extra_info" maxlength="500"
                          placeholder="Любая дополнительная информация"><?= isset($data['extra_info']) ? $data['extra_info'] : "" ?></textarea>
                <span>
                    Всё, что может быть полезным: хештеги, пожелания, пр.
                </span>
            </label>
            <input type="submit" class="btn-send" name="offer_bot_submit"/>
        </form>
    </div>
</div>

<?php require_once(ROOT . '/views/layouts/menu.php'); ?>

<div class="slider-block-bots-2">
</div>
<div class="block-list-bots">

    <?php if (isset($data['error'])) { ?>
        <div class="request_notif_error">
            <span><?= $data['error'] ?></span>
        </div>
    <?php } else if (isset($data['success'])) { ?>
        <div class="request_notif_success">
            <span><?= $data['success'] ?></span>
        </div>
    <?php } ?>

    <div class="wrapper">

        <?php
        $num_of_bots = count($data['bots']);
        foreach ($data['bots'] as $bot): ?>
            <div class="segment-bots">
                <a href="<?= $bot['link'] ?>" target="_blank" class="btn-add-bots"></a>
                <div class="img-bots-seg">
                    <img src="/template/img/bots/<?= $bot['image'] ?>" alt="">
                </div>
                <div class="block-text-bots">
                    <h3>
                        <?= $bot['title'] ?>
                    </h3>
                    <span class="tag-bots">
                        @<?= $bot['username'] ?>
                    </span>
                    <p>
                        <?= $bot['description'] ?>
                    </p>
                </div>
                <div class="clear"></div>
            </div>
        <?php endforeach;
        if ($num_of_bots == 0) { ?>
            <div class="block-catalog">
                <h3>
                    Боты отсутствуют. Предложите своего!<br>
                </h3>
            </div>
            <?php
        } ?>

        <a href="javascript:;" class="btn-dop-bot">
            предложить бота
        </a>
    </div>
</div>
</body>
</html>