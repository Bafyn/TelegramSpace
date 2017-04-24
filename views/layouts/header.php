<!DOCTYPE html>
<html>
<head>
    <meta charset="windows-1251">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="/views/admin/assets/font-awesome/css/font-awesome.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="/template/css/main.css"/>
    <link rel="stylesheet" type="text/css" href="/template/css/fonts.css"/>
    <link rel="stylesheet" type="text/css" href="/template/css/media.css"/>
    <script src="/template/js/jquery-1.8.2.min.js"></script>
    <script src="/template/js/js-realst.js"></script>
    <?php
    if (!Admin::is_admin_logged()): ?>
        <script type="application/javascript">
            $(document).ready(function () {
                $('.edit_page_part').remove();
            });
        </script>
    <?php endif; ?>
    <title>Telegram Space</title>
</head>
<body>

<div class="modalAddCanal modal_edit_content_text">
    <div class="contentCanalAdd" style="width: 600px;">
        <div class="btn-close"></div>
        <h3><span class="line-title"></span> Изменить текст</h3>
        <form method="post">
            <input type="hidden" name="secret_edit_content_text" value="<?= rand(); ?>"/>
            <input type="hidden" class="content_part"/>
            <input type="hidden" class="page_name"/>
            <div class="clear"></div>
            <label class="label-2">
                Значение:<br>
                <textarea name="content_value" maxlength="100" placeholder="Содержимое контента"></textarea>
                <span>Максимальное количество символов: </span>
                <span class="current_amount_of_symbols">0</span> /
                <span class="max_amount_of_symbols_edit_content">100</span>
            </label>
            <input class="btn-send change_content_text_submit" value="Сохранить" type="button"/>
        </form>
    </div>
</div>

<div class="modalAddCanal modal_edit_content_image">
    <div class="contentCanalAdd" style="width: 400px;">
        <div class="btn-close"></div>
        <h3><span class="line-title"></span> Изменить изображение</h3>
        <form method="post" style="text-align: center;">
            <input type="hidden" name="secret_edit_content_image" value="<?= rand(); ?>"/>
            <input type="hidden" class="content_part"/>
            <input type="hidden" class="page_name"/>
            <div class="clear"></div>
            <label class="label-2">
                <input type="file" name="content_image" style="margin-bottom: 20px;"/>
                <span>Рекомендуемый размер: </span>
                <span class="max_size_of_image_edit_content">640x420</span>
            </label>
            <input class="btn-send change_content_image_submit" value="Сохранить" type="button"/>
        </form>
    </div>
</div>