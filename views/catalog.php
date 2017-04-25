<?php require_once(ROOT . '/views/layouts/header.php'); ?>

<div class="modalAddCanal modal_edit_category">
    <div class="contentCanalAdd">
        <div class="btn-close"></div>
        <h3><span class="line-title"></span> Предложить канал</h3>
        <form method="post">
            <input type="hidden" name="secret_offer_channel" value="<?= rand(); ?>"/>
            <label class="label-1">
                Ссылка на канал<span class="obligatory_field">*</span>:<br>
                <input type="text" maxlength="100" required placeholder="https://t.me/" name="channel_link"
                       class="inp-form"
                       value="<?= isset($data['link']) ? $data['link'] : 'https://t.me/' ?>"/>
            </label>
            <label class="label-1">
                Категория:<br>
                <select name="channel_category">
                    <?php foreach ($data['categories'] as $category): ?>
                        <option>
                            <?= $category['title'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </label>
            <div class="clear"></div>
            <label class="label-2">
                Название<span class="obligatory_field">*</span>:<br>
                <input type="text" required maxlength="30" name="channel_title" class="inp-form"
                       placeholder="Название канала"
                       value="<?= isset($data['title']) ? $data['title'] : "" ?>"/>
            </label>
            <label class="label-2">
                Описание:<br>
                <textarea name="channel_description" maxlength="100"
                          placeholder="Описание канала"><?= isset($data['description']) ? $data['description'] : "" ?></textarea>
                <span>
                    Можно не указывать: описание будет взято из канала
                </span>
            </label>
            <label class="label-2">
                Дополнительная информация:<br>
                <textarea name="channel_extra_info" maxlength="500"
                          placeholder="Любая дополнительная информация"><?= isset($data['extra_info']) ? $data['extra_info'] : "" ?></textarea>
                <span>
                    Всё, что может быть полезным: хештеги, пожелания, пр.
                </span>
            </label>
            <input class="btn-send" name="offer_channel_submit" type="submit"/>
        </form>
    </div>
</div>

<?php require_once(ROOT . '/views/layouts/menu.php'); ?>

<div class="slider-block-catalog"
     style="background-image: url('<?= $data['part_47']['code'] ?>')">
    <div class="wrapper">
        <i class="fa fa-cogs image_elem part_47"
           aria-hidden="true"
           style="position:relative; top: 20px;"></i>
        <div class="block-title-head">
            <h3>
                <i><img src="/template/img/icon/i-1.png" alt=""></i><br>
                <i class="fa fa-cogs text_elem part_48"
                   aria-hidden="true"></i>
                <span class="part_48"><?= $data['part_48']['code'] ?></span>
            </h3>
        </div>
    </div>
</div>
<div class="block-catalog">

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
        <h3>
            <i class="fa fa-cogs text_elem part_49" aria-hidden="true"></i>
            <span class="part_49"><?= $data['part_49']['code'] ?></span>
            <br>
            <span>
                <i class="fa fa-cogs text_elem part_50" aria-hidden="true"></i>
                <span class="part_50"><?= $data['part_50']['code'] ?></span>
            </span>

        </h3>
        <p>
            <i class="fa fa-cogs text_elem part_51" aria-hidden="true"></i>
            <span class="part_51"><?= $data['part_51']['code'] ?></span>
        </p>

    </div>
</div>
<div class="list-canal">
    <div class="wrapper">
        <h3>Интересные каналы Telegram</h3>
        <ul>
            <?php foreach ($data['categories'] as $category): ?>
                <li style="background: url('/template/img/categories/<?= $category['image'] ?>') no-repeat top center;">
                    <a href="/channel?category=<?= $category['id'] ?>">
                        <span><?= $category['title'] ?></span>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <div class="clear"></div>
    </div>
</div>
<div class="bottom-category">
    <div class="wrapper">
        <p>
            Найди интересные тебе каналы, получай бесплатно самую свежую информацию, расширяй<br>
            свой кругозор и будь всегда в тренде.
        </p>
    </div>
</div>
<a href="javascript:;" class="btn-dop-canal" style="margin-top: 0;">
    предложить канал
</a>
</body>
</html>