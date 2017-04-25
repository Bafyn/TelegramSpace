$(document).ready(function () {
    $(".menu-phone-btn").click(function () {
        $(".menu-phone-content").slideToggle(400);
    });

    $(".btn-close").click(function () {
        $(".modalAddCanal, .modalAddBot, .modal_edit_content_text, .modal_edit_content_image").hide();
    });

    $(".btn-dop-canal").click(function () {
        $(".modalAddCanal").show();
    });

    $(".btn-dop-bot").click(function () {
        $(".modalAddBot").show();
    });

//        Scroll to top by button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 0) {
            $('.go-top').fadeIn();
        } else {
            $('.go-top').fadeOut();
        }
    });
    $('.go-top').click(function () {
        $('body,html').animate({
            scrollTop: 0
        }, 400);
        return false;
    });
//        /Scroll to top by button

    function hideAllModals(not_to_hide_modal) {
        if (not_to_hide_cont != 1) {
            $('.modal_edit_content_text').slideUp();
        }

        if (not_to_hide_cont != 2) {
            $('.modal_edit_content_image').slideUp();
        }

        if (not_to_hide_cont != 3) {
            $('.modal_edit_bot').slideUp();
        }

        if (not_to_hide_cont != 4) {
            $('.modal_edit_category').slideUp();
        }
    }

    $('i[class*="image_elem"] ').click(function (e) {
        var element_id = e.target.getAttribute('class').split(' ').filter(function (elem) {
            return elem.indexOf('part') == 0;
        })[0];

        $.ajax({
            url: '/ajax.php',
            type: 'POST',
            data: 'purpose=get_old_content&element_id=' + element_id,
            success: function (data) {
                if (data === 'error') {
                    alert('Произошла ошибка. Попробуйте позже');
                    return;
                }

                data = JSON.parse(data);

                $('.modal_edit_content_image .content_part').val(data['id']);
                $('.max_size_of_image_edit_content').text(data['max_size']);
                $('.modal_edit_content_image').show();
            }
        });
    });

    $('i[class*="text_elem"] ').click(function (e) {

        // Changing number of entered symbols
        var edit_content_textarea = $('#input_new_content');
        edit_content_textarea[0].oninput = function () {
            edit_content_textarea = $('#input_new_content');
            var current_amount = edit_content_textarea.val().length;
            var max_amount = $('.max_amount_of_symbols_edit_content').text();

            if (current_amount <= max_amount) {
                $('.current_amount_of_symbols').text(current_amount);
            } else {
                $('.current_amount_of_symbols').text(max_amount);
                edit_content_textarea.val(edit_content_textarea.val().substr(0, max_amount));
            }
        };
        // /Changing number of entered symbols

        var element_id = e.target.getAttribute('class').split(' ').filter(function (elem) {
            return elem.indexOf('part') == 0;
        })[0];

        $.ajax({
            url: '/ajax.php',
            type: 'POST',
            data: 'purpose=get_old_content&element_id=' + element_id,
            success: function (data) {
                if (data === 'error') {
                    alert('Произошла ошибка. Попробуйте позже');
                    return;
                }

                data = JSON.parse(data);

                $('.modal_edit_content_text .content_part').val(data['id']);
                $('.current_amount_of_symbols').text(data['code'].length);
                $('.max_amount_of_symbols_edit_content').text(data['max_size']);
                $('#input_new_content').val(data['code']);
                $('.modal_edit_content_text').show();
            }
        });
    });

    $('.change_content_text_submit').click(function () {
        var element_id = $('.modal_edit_content_text .content_part').val();
        var new_content = $('#input_new_content').val();

        $.ajax({
            url: '/ajax.php',
            type: 'POST',
            data: 'purpose=edit_content_text&element_id=' + element_id + '&new_content=' + new_content,
            success: function (data) {
                if (data === 'error') {
                    alert('Произошла ошибка. Попробуйте позже');
                    return;
                }

                alert('Содержимое было успешно изменено!');
                location.reload();
            }
        });
    });

    $('.change_content_image_submit').click(function () {
        var element_id = $('.modal_edit_content_image .content_part').val();
        var image = $('#input_new_image');
        var extension = image.val().slice(image.val().lastIndexOf('.') + 1);

        if (extension !== 'jpg' && extension !== 'png') {
            $('#edit_content_image_error').text("Загружаемые изображения могуть иметь формат только .png или .jpg");
            $('.modal_edit_content_image label:nth-of-type(2)').css('display', 'block');
            return;
        }

        var fd = new FormData();
        fd.append('img', image.prop('files')[0], image.val());
        fd.append('purpose', 'edit_content_image');
        fd.append('element_id', element_id);

        $.ajax({
            url: '/ajax.php',
            type: 'POST',
            processData: false,
            contentType: false,
            data: fd,
            success: function (data) {
                if (data === 'error') {
                    alert('Произошла ошибка. Попробуйте позже');
                    return;
                }

                alert('Содержимое было успешно изменено!');
                location.reload();
            }
        });
    });

    // Admin menu action
    function hideAllTables(not_to_hide_cont) {
        if (not_to_hide_cont != 1) {
            $('.channels_table_cont').slideUp();
        }

        if (not_to_hide_cont != 2) {
            $('.bots_table_cont').slideUp();
        }

        if (not_to_hide_cont != 3) {
            $('.articles_table_cont').slideUp();
        }

        if (not_to_hide_cont != 4) {
            $('.stickers_table_cont').slideUp();
        }

        if (not_to_hide_cont != 5) {
            $('.categories_table_cont').slideUp();
        }

        if (not_to_hide_cont != 6) {
            $('.editor_cont').slideUp();
        }
    }

    $('.channels_menu').click(function () {
        hideAllTables(1);
        $('.channels_table_cont').slideDown();
    });

    $('.bots_menu').click(function () {
        hideAllTables(2);
        $('.bots_table_cont').slideDown();
    });

    $('.articles_menu').click(function () {
        hideAllTables(3);
        $('.articles_table_cont').slideDown();
    });

    $('.stickers_menu').click(function () {
        hideAllTables(4);
        $('.stickers_table_cont').slideDown();
    });

    $('.categories_menu').click(function () {
        hideAllTables(5);
        $('.categories_table_cont').slideDown();
    });
    // /Admin menu action

    $('.add_category_btn').click(function () {
        $('#modal_edit_category .modal-title').text('Добавить категорию канала');
        $('#modal_edit_category form').attr('action', '/admin/addcategory');
        $('.category_title').val("");
        $('.category_image').attr('src', '/template/img/categories/noimage.png');
        $('.category_status').prop('checked', false);
    });

    $('.add_article_btn').click(function () {
        hideAllTables(6);
        $('.editor_cont').slideDown();
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