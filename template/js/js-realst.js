$(document).ready(function () {
    $(".menu-phone-btn").click(function () {
        $(".menu-phone-content").slideToggle(400);
    });

    $(".btn-close").click(function () {
        $(".modalAddCanal, .modalAddBot").hide();
    });

    $(".btn-dop-canal").click(function () {
        $(".modalAddCanal").show();
    });

    $(".btn-dop-bot").click(function () {
        $(".modalAddBot").show();
    });

    $('.add_category_btn').click(function () {
        $('#modal_edit_category .modal-title').text('Добавить категорию канала');
        $('#modal_edit_category form').attr('action', '/admin/addcategory');
        $('.category_title').val("");
        $('.category_image').attr('src', '/template/img/categories/noimage.png');
        $('.category_status').prop('checked', false);
    });

    $('.edit_channel_btn').click(function (e) {
        var channel_old_link = e.target.parentElement.parentElement.children[0].children[0].getAttribute("href");

        if (e.target.nodeName == "I") {
            channel_old_link = e.target.parentElement.parentElement.parentElement.children[0].children[0].getAttribute("href");
        }

        $.ajax({
            url: '/ajax.php',
            type: 'POST',
            data: 'purpose=edit_channel&channel_old_link=' + channel_old_link,
            success: function (data) {
                if (data === 'error') {
                    alert('Произошла ошибка при заполнении данных. Попробуйте позже');
                    return;
                }

                data = JSON.parse(data);
                var channel_category = data['category'];

                $('.channel_link').val(data['link']);
                $('.channel_title').val(data['title']);
                $('.channel_description').text(data['description']);
                $('.channel_members').val(data['members']);
                $('.channel_rating').val(data['rating']);
                $('.channel_extra_info').text(data['extra_info']);
                $(".channel_category option:contains('" + channel_category + "')").attr("selected", "selected");
                $('.channel_image').attr('src', '/template/img/channels/' + data['image']);
                $('.channel_status').prop('checked', data['status'] === '1' ? true : false);
            }
        });
    });

    $('.delete_channel_btn').click(function (e) {
        var channel_old_link = e.target.parentElement.parentElement.children[0].children[0].getAttribute("href");

        if (e.target.nodeName == "I") {
            channel_old_link = e.target.parentElement.parentElement.parentElement.children[0].children[0].getAttribute("href");
        }

        var isDelete = confirm("Удалить канал со ссылкой " + channel_old_link + "?");

        if (isDelete) {
            $.ajax({
                url: '/ajax.php',
                type: 'POST',
                data: 'purpose=delete_channel&channel_old_link=' + channel_old_link,
                success: function (data) {
                    if (data === 'error') {
                        alert('Произошла ошибка. Попробуйте позже');
                        return;
                    }

                    channel_old_link = channel_old_link.slice(channel_old_link.lastIndexOf('/') + 1);

                    $('.channel_record').remove(':contains(' + channel_old_link + ')');
                    alert('Канал был успешно удален!');
                }
            });
        }
    });

    $('.edit_bot_btn').click(function (e) {
        var bot_old_link = e.target.parentElement.parentElement.children[0].children[0].getAttribute("href");
        var bot_old_username = e.target.parentElement.parentElement.children[1].innerText;

        if (e.target.nodeName == "I") {
            bot_old_link = e.target.parentElement.parentElement.parentElement.children[0].children[0].getAttribute("href");
            bot_old_username = e.target.parentElement.parentElement.parentElement.children[1].innerText;
        }

        $.ajax({
            url: '/ajax.php',
            type: 'POST',
            data: 'purpose=edit_bot&bot_old_link=' + bot_old_link + '&bot_old_username=' + bot_old_username,
            success: function (data) {
                if (data === 'error') {
                    alert('Произошла ошибка при заполнении данных. Попробуйте позже');
                    return;
                }

                data = JSON.parse(data);

                $('.bot_link').val(data['link']);
                $('.bot_username').val(data['username']);
                $('.bot_title').val(data['title']);
                $('.bot_description').text(data['description']);
                $('.bot_rating').val(data['rating']);
                $('.bot_extra_info').text(data['extra_info']);
                $('.bot_image').attr('src', '/template/img/bots/' + data['image']);
                $('.bot_status').prop('checked', data['status'] === '1' ? true : false);
            }
        });
    });

    $('.delete_bot_btn').click(function (e) {
        var bot_old_link = e.target.parentElement.parentElement.children[0].children[0].getAttribute("href");

        if (e.target.nodeName == "I") {
            bot_old_link = e.target.parentElement.parentElement.parentElement.children[0].children[0].getAttribute("href");
        }

        var isDelete = confirm("Удалить бота со ссылкой " + bot_old_link + "?");

        if (isDelete) {
            $.ajax({
                url: '/ajax.php',
                type: 'POST',
                data: 'purpose=delete_bot&bot_old_link=' + bot_old_link,
                success: function (data) {
                    if (data === 'error') {
                        alert('Произошла ошибка. Попробуйте позже');
                        return;
                    }

                    bot_old_link = bot_old_link.slice(bot_old_link.lastIndexOf('/') + 1);

                    $('.bot_record').remove(':contains(' + bot_old_link + ')');
                    alert('Бот был успешно удален!');
                }
            });
        }
    });

    $('.edit_category_btn').click(function (e) {
        $('#modal_edit_category .modal-title').text('Редактировать категорию канала');
        $('#modal_edit_category form').attr('action', '/admin/editcategory');

        var category_old_title = e.target.parentElement.parentElement.children[0].innerText;

        if (e.target.nodeName == "I") {
            category_old_title = e.target.parentElement.parentElement.parentElement.children[0].innerText;
        }

        $.ajax({
            url: '/ajax.php',
            type: 'POST',
            data: 'purpose=edit_category&category_old_title=' + category_old_title,
            success: function (data) {
                if (data === 'error') {
                    alert('Произошла ошибка при заполнении данных. Попробуйте позже');
                    return;
                }

                data = JSON.parse(data);

                $('.category_title').val(data['title']);
                $('.category_image').attr('src', '/template/img/categories/' + data['image']);
                $('.category_status').prop('checked', data['status'] === '1' ? true : false);
            }
        });
    });

    $('.delete_category_btn').click(function (e) {
        var bot_old_link = e.target.parentElement.parentElement.children[0].children[0].getAttribute("href");

        if (e.target.nodeName == "I") {
            bot_old_link = e.target.parentElement.parentElement.parentElement.children[0].children[0].getAttribute("href");
        }

        var isDelete = confirm("Удалить бота со ссылкой " + bot_old_link + "?");

        if (isDelete) {
            $.ajax({
                url: '/ajax.php',
                type: 'POST',
                data: 'purpose=delete_bot&bot_old_link=' + bot_old_link,
                success: function (data) {
                    if (data === 'error') {
                        alert('Произошла ошибка. Попробуйте позже');
                        return;
                    }

                    bot_old_link = bot_old_link.slice(bot_old_link.lastIndexOf('/') + 1);

                    $('.bot_record').remove(':contains(' + bot_old_link + ')');
                    alert('Бот был успешно удален!');
                }
            });
        }
    });

});