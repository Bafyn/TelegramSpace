<?php
if (!Admin::is_admin_logged()) {
    Router::header_location('/admin/login');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="Dashboard">
    <meta name="keyword" content="Dashboard, Bootstrap, Admin, Template, Theme, Responsive, Fluid, Retina">

    <title>Telegram Space - Admin</title>

    <!-- Bootstrap core CSS -->
    <link href="/views/admin/assets/css/bootstrap.css" rel="stylesheet">
    <!--external css-->
    <link href="/views/admin/assets/font-awesome/css/font-awesome.css" rel="stylesheet"/>
    <link rel="stylesheet" type="text/css" href="/views/admin/assets/css/zabuto_calendar.css">
    <link rel="stylesheet" type="text/css" href="/views/admin/assets/js/gritter/css/jquery.gritter.css"/>
    <link rel="stylesheet" type="text/css" href="/views/admin/assets/lineicons/style.css">

    <!-- Custom styles for this template -->
    <link href="/views/admin/assets/css/style.css" rel="stylesheet">
    <link href="/views/admin/assets/css/style-responsive.css" rel="stylesheet">

    <script src="/views/admin/assets/js/chart-master/Chart.js"></script>

    <!--CKEditor-->
    <script src="/ckeditor/ckeditor.js"></script>

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
<section id="container">

    <!-- Modal edit channel-->
    <div class="modal fade" id="modal_edit_channel" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Редактировать канал</h4>
                </div>
                <form method="post" action="/admin/editchannel" enctype="multipart/form-data"
                      class="form-horizontal style-form">
                    <div class="modal-body">
                        <input type="hidden" name="secret_edit_channel" value="<?= rand(); ?>"/>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Ссылка</label>
                            <div class="col-sm-10">
                                <input type="text" maxlength="100" required placeholder="Ссылка" name="channel_link"
                                       class="form-control channel_link">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Название</label>
                            <div class="col-sm-10">
                                <input type="text" maxlength="30" required placeholder="Название" name="channel_title"
                                       class="form-control channel_title">
                                <span class="help-block">Максимальная длина - 30 символов</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Описание</label>
                            <div class="col-sm-10">
                                <textarea placeholder="Описание" name="channel_description" maxlength="100"
                                          class="form-control channel_description"></textarea>
                                <span class="help-block">Максимальная длина - 100 символов</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Категория</label>
                            <div class="col-sm-10">
                                <select class="form-control channel_category" name="channel_category">
                                    <?php foreach ($data['channel_categories'] as $category): ?>
                                        <option><?= $category['title'] ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Участники</label>
                            <div class="col-sm-10">
                                <input type="text" placeholder="Участники" name="channel_members"
                                       class="form-control channel_members">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Картинка</label>
                            <div class="col-sm-7">
                                <input type="file" name="channel_image" class="form-control"/>
                                <span class="help-block">Наилучший размер - 42x42 пикселей</span>
                            </div>
                            <div class="col-sm-3 edit_subject_img">
                                <img src="" class="channel_image">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Рейтинг</label>
                            <div class="col-sm-10">
                                <input type="text" placeholder="Рейтинг" name="channel_rating"
                                       class="form-control channel_rating">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Доп. инфо</label>
                            <div class="col-sm-10">
                                <textarea placeholder="Доп. инфо" name="channel_extra_info" maxlength="500"
                                          class="form-control channel_extra_info"></textarea>
                                <span class="help-block">Максимальная длина - 500 символов</span>
                            </div>
                        </div>
                        <div class="checkbox chackbox_status">
                            <label>
                                <input type="checkbox" class="channel_status" name="channel_status">
                                Опубликовать канал
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer modal_footer_admin">
                        <input type="submit" name="edit_channel_submit" class="btn btn-lg btn-primary"
                               value="Сохранить"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Modal edit channel-->

    <!-- Modal edit bot-->
    <div class="modal fade" id="modal_edit_bot" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Редактировать бота</h4>
                </div>
                <form method="post" action="/admin/editbot" enctype="multipart/form-data"
                      class="form-horizontal style-form">
                    <div class="modal-body">
                        <input type="hidden" name="secret_edit_bot" value="<?= rand(); ?>"/>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Ссылка</label>
                            <div class="col-sm-10">
                                <input type="text" maxlength="100" required placeholder="Ссылка" name="bot_link"
                                       class="form-control bot_link">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Username</label>
                            <div class="col-sm-10">
                                <input type="text" maxlength="90" required placeholder="Название" name="bot_username"
                                       class="form-control bot_username">
                                <span class="help-block">Максимальная длина - 90 символов</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Название</label>
                            <div class="col-sm-10">
                                <input type="text" maxlength="50" required placeholder="Название" name="bot_title"
                                       class="form-control bot_title">
                                <span class="help-block">Максимальная длина - 50 символов</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Описание</label>
                            <div class="col-sm-10">
                                <textarea placeholder="Описание" required name="bot_description" maxlength="200"
                                          class="form-control bot_description"></textarea>
                                <span class="help-block">Максимальная длина - 200 символов</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Картинка</label>
                            <div class="col-sm-7">
                                <input type="file" placeholder="https://t.me/" name="bot_image"
                                       class="form-control">
                                <span class="help-block">Наилучший размер - 140x140 пикселей</span>
                            </div>
                            <div class="col-sm-3 edit_subject_img">
                                <img class="bot_image" src="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Рейтинг</label>
                            <div class="col-sm-10">
                                <input type="text" placeholder="Рейтинг" name="bot_rating"
                                       class="form-control bot_rating">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Доп. инфо</label>
                            <div class="col-sm-10">
                                <textarea placeholder="Доп. инфо" name="bot_extra_info" maxlength="500"
                                          class="form-control bot_extra_info"></textarea>
                                <span class="help-block">Максимальная длина - 500 символов</span>
                            </div>
                        </div>
                        <div class="checkbox chackbox_status">
                            <label>
                                <input type="checkbox" class="bot_status" name="bot_status">
                                Опубликовать бота
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer modal_footer_admin">
                        <input type="submit" name="edit_bot_submit" class="btn btn-lg btn-primary" value="Сохранить"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Modal edit bot-->

    <!-- Modal edit article-->
    <div class="modal fade" id="modal_edit_article" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Редактировать статью</h4>
                </div>
                <form method="post" action="/admin/editarticle" enctype="multipart/form-data"
                      class="form-horizontal style-form">
                    <div class="modal-body">
                        <input type="hidden" name="secret_edit_article" value="<?= rand(); ?>"/>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Название</label>
                            <div class="col-sm-10">
                                <input type="text" maxlength="150" required placeholder="Название" name="article_title"
                                       class="form-control">
                                <span class="help-block">Максимальная длина - 150 символов</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Содержимое</label>
                            <div class="col-sm-10">
                                <textarea placeholder="Содержимое" name="article_description" required
                                          maxlength="5000" class="form-control"></textarea>
                                <span class="help-block">Максимальная длина - 5000 символов</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Дата публикации</label>
                            <div class="col-sm-10">
                                <input type="date" required name="article_category" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Картинка</label>
                            <div class="col-sm-7">
                                <input type="file" placeholder="https://t.me/" name="article_image"
                                       class="form-control">
                                <span class="help-block">Наилучший размер - 470x310 пикселей (но возможны и другие)</span>
                            </div>
                            <div class="col-sm-3 edit_subject_img">
                                <img src="/template/img/articles/c-1.png">
                            </div>
                        </div>
                        <div class="checkbox chackbox_status">
                            <label>
                                <input type="checkbox" name="article_status">
                                Опубликовать статью
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer modal_footer_admin">
                        <input type="submit" name="edit_article_submit" class="btn btn-lg btn-primary"
                               value="Сохранить"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Modal edit article-->

    <!-- Modal edit sticker-->
    <div class="modal fade" id="modal_edit_sticker" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Редактировать стикеры</h4>
                </div>
                <form method="post" action="/admin/editsticker" enctype="multipart/form-data"
                      class="form-horizontal style-form">
                    <input type="hidden" name="secret_edit_sticker" value="<?= rand(); ?>"/>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Название</label>
                            <div class="col-sm-10">
                                <input type="text" maxlength="50" required placeholder="Название" name="sticker_title"
                                       class="form-control">
                                <span class="help-block">Максимальная длина - 50 символов</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Описание</label>
                            <div class="col-sm-10">
                                <textarea placeholder="Описание" name="sticker_description" required
                                          maxlength="200" class="form-control"></textarea>
                                <span class="help-block">Максимальная длина - 200 символов</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Картинка</label>
                            <div class="col-sm-7">
                                <input type="file" placeholder="https://t.me/" name="sticker_image"
                                       class="form-control">
                                <span class="help-block">Наилучший размер - 510x330 пикселей (но возможны и другие)</span>
                            </div>
                            <div class="col-sm-3 edit_subject_img">
                                <img src="/template/img/stickers/c-1.png">
                            </div>
                        </div>
                        <div class="checkbox chackbox_status">
                            <label>
                                <input type="checkbox" name="sticker_status">
                                Опубликовать стикеры
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer modal_footer_admin">
                        <input type="submit" name="edit_sticker_submit" class="btn btn-lg btn-primary"
                               value="Сохранить"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Modal edit sticker-->

    <!-- Modal edit category-->
    <div class="modal fade" id="modal_edit_category" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">Редактировать категорию канала</h4>
                </div>
                <form method="post" action="/admin/editcategory" enctype="multipart/form-data"
                      class="form-horizontal style-form">
                    <input type="hidden" name="secret_edit_category" value="<?= rand(); ?>"/>
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Название</label>
                            <div class="col-sm-10">
                                <input type="text" required maxlength="25" placeholder="Название" name="category_title"
                                       class="form-control category_title">
                                <span class="help-block">Максимальная длина - 25 символов</span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 col-sm-2 control-label">Картинка</label>
                            <div class="col-sm-7">
                                <input type="file" placeholder="https://t.me/" name="category_image"
                                       class="form-control">
                                <span class="help-block">Наилучший размер - 366x170 пикселей (но возможны и другие)</span>
                            </div>
                            <div class="col-sm-3 edit_subject_img">
                                <img class="category_image" src="">
                            </div>
                        </div>
                        <div class="checkbox chackbox_status">
                            <label>
                                <input type="checkbox" class="category_status" name="category_status">
                                Опубликовать категорию
                            </label>
                        </div>
                    </div>
                    <div class="modal-footer modal_footer_admin">
                        <input type="submit" name="edit_category_submit" class="btn btn-lg btn-primary"
                               value="Сохранить"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- /Modal edit category-->

    <!-- **********************************************************************************************************************************************************
    TOP BAR CONTENT & NOTIFICATIONS
    *********************************************************************************************************************************************************** -->
    <!--header start-->
    <header class="header black-bg">
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars tooltips" data-placement="right" data-original-title="Toggle Navigation"></div>
        </div>
        <!--logo start-->
        <a href="/admin" class="logo"><b>TELEGRAM SPACE</b></a>
        <!--logo end-->
        <div class="nav notify-row" id="top_menu">
            <!--  notification start -->
            <ul class="nav top-menu">
                <!-- settings start -->
                <li class="dropdown">
                    <a data-toggle="dropdown" class="dropdown-toggle" href="index.html#index.php">
                        <i class="fa fa-tasks"></i>
                        <span class="badge bg-theme">4</span>
                    </a>
                    <ul class="dropdown-menu extended tasks-bar">
                        <div class="notify-arrow notify-arrow-green"></div>
                        <li>
                            <p class="green">You have 4 pending tasks</p>
                        </li>
                        <li>
                            <a href="index.html#index.php">
                                <div class="task-info">
                                    <div class="desc">DashGum Admin Panel</div>
                                    <div class="percent">40%</div>
                                </div>
                                <div class="progress progress-striped">
                                    <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="40"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 40%">
                                        <span class="sr-only">40% Complete (success)</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="index.html#index.php">
                                <div class="task-info">
                                    <div class="desc">Database Update</div>
                                    <div class="percent">60%</div>
                                </div>
                                <div class="progress progress-striped">
                                    <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="60"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 60%">
                                        <span class="sr-only">60% Complete (warning)</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="index.html#index.php">
                                <div class="task-info">
                                    <div class="desc">Product Development</div>
                                    <div class="percent">80%</div>
                                </div>
                                <div class="progress progress-striped">
                                    <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="80"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 80%">
                                        <span class="sr-only">80% Complete</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li>
                            <a href="index.html#index.php">
                                <div class="task-info">
                                    <div class="desc">Payments Sent</div>
                                    <div class="percent">70%</div>
                                </div>
                                <div class="progress progress-striped">
                                    <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="70"
                                         aria-valuemin="0" aria-valuemax="100" style="width: 70%">
                                        <span class="sr-only">70% Complete (Important)</span>
                                    </div>
                                </div>
                            </a>
                        </li>
                        <li class="external">
                            <a href="#">See All Tasks</a>
                        </li>
                    </ul>
                </li>
                <!-- settings end -->
            </ul>
            <!--  notification end -->
        </div>
        <div class="top-menu">
            <ul class="nav pull-right top-menu">
                <li><a class="logout" href="/">Вернуться на сайт</са></a></li>
                <li><a class="logout" href="/admin/signout">Выйти</a></li>
            </ul>
        </div>
    </header>
    <!--header end-->

    <!-- **********************************************************************************************************************************************************
    MAIN SIDEBAR MENU
    *********************************************************************************************************************************************************** -->
    <!--sidebar start-->
    <aside>
        <div id="sidebar" class="nav-collapse ">
            <!-- sidebar menu start-->
            <ul class="sidebar-menu" id="nav-accordion">
                <p class="centered">
                    <a href="javascript:;">
                        <img src="/views/admin/assets/img/ui-sam.jpg" class="img-circle" width="60">
                    </a>
                </p>
                <h5 class="centered"><?= $data['admin']['email'] ?></h5>

                <li class="mt">
                    <a class="active channels_menu" href="javascript:;">
                        <i class="fa fa-desktop"></i>
                        <span>Каналы</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;" class="bots_menu">
                        <i class="fa fa-cogs"></i>
                        <span>Боты</span>
                    </a>
                </li>

                <li class="sub-menu">
                    <a href="javascript:;" class="articles_menu">
                        <i class="fa fa-book"></i>
                        <span>Статьи</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;" class="stickers_menu">
                        <i class="fa fa-picture-o"></i>
                        <span>Стикеры</span>
                    </a>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;" class="categories_menu">
                        <i class="fa fa-stack-overflow"></i>
                        <span>Категории каналов</span>
                    </a>
                    <ul class="sub">
                        <li class="active"><a href="javascript:;" class="categories_menu">Список</a></li>
                        <li><a href="javascript:;" data-toggle="modal" data-target="#modal_edit_category"
                               class="add_category_btn">Добавить категорию</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-pencil"></i>
                        <span>Редактировать страницы</span>
                    </a>
                    <ul class="sub">
                        <li>
                            <a href="javascript:;" data-toggle="modal" data-target="#modal_edit_page_main"
                               class="modal_edit_page_main">Главная</a>
                        </li>
                        <li>
                            <a href="javascript:;" data-toggle="modal" data-target="#modal_edit_page_history"
                               class="modal_edit_page_history">История TELEGRAM</a>
                        </li>
                        <li>
                            <a href="javascript:;" data-toggle="modal" data-target="#modal_edit_page_about_channels"
                               class="modal_edit_page_about_channels">О каналах</a>
                        </li>
                        <li>
                            <a href="javascript:;" data-toggle="modal" data-target="#modal_edit_page_channels_catalog"
                               class="modal_edit_page_channels_catalog">Каталог каналов</a>
                        </li>
                        <li>
                            <a href="javascript:;" data-toggle="modal" data-target="#modal_edit_page_technologies"
                               class="modal_edit_page_technologies">Технологии</a>
                        </li>
                        <li>
                            <a href="javascript:;" data-toggle="modal" data-target="#modal_edit_page_about_bots"
                               class="modal_edit_page_about_bots">О ботах</a>
                        </li>
                        <li>
                            <a href="javascript:;" data-toggle="modal" data-target="#modal_edit_page_bots_catalog"
                               class="modal_edit_page_bots_catalog">Каталог ботов</a>
                        </li>
                        <li>
                            <a href="javascript:;" data-toggle="modal" data-target="#modal_edit_page_stickers_catalog"
                               class="modal_edit_page_stickers_catalog">Каталог стикеров</a>
                        </li>
                        <li>
                            <a href="javascript:;" data-toggle="modal" data-target="#modal_edit_page_create_stickers"
                               class="modal_edit_page_create_stickers">Создать стикеры</a>
                        </li>
                        <li>
                            <a href="javascript:;" data-toggle="modal" data-target="#modal_edit_page_articles"
                               class="modal_edit_page_articles">Статьи</a>
                        </li>
                    </ul>
                </li>
            </ul>
            <!-- sidebar menu end-->
        </div>
    </aside>
    <!--sidebar end-->

    <!-- **********************************************************************************************************************************************************
    MAIN CONTENT
    *********************************************************************************************************************************************************** -->
    <!--main content start-->
    <section id="main-content">
        <section class="wrapper">

            <div class="row">
                <div class="col-lg-9 main-chart">

                    <div class="row mtbox">
                        <div class="col-md-2 col-sm-2 col-md-offset-1 box0">
                            <div class="box1">
                                <span class="li_tv"></span>
                                <h3><?= $data['active_channels_num'] ?></h3>
                            </div>
                            <p>Каналов уже опубликовано!</p>
                        </div>
                        <div class="col-md-2 col-sm-2 box0">
                            <div class="box1">
                                <span class="li_settings"></span>
                                <h3><?= $data['active_bots_num'] ?></h3>
                            </div>
                            <p>Ботов уже запущено!</p>
                        </div>
                        <div class="col-md-2 col-sm-2 box0">
                            <div class="box1">
                                <span class="li_note"></span>
                                <h3><?= $data['active_articles_num'] ?></h3>
                            </div>
                            <p>Статей опубликовано!</p>
                        </div>
                        <div class="col-md-2 col-sm-2 box0">
                            <div class="box1">
                                <span class="li_photo"></span>
                                <h3><?= $data['active_articles_num'] ?></h3>
                            </div>
                            <p>Наборов стикеров активно!</p>
                        </div>
                        <div class="col-md-2 col-sm-2 box0">
                            <div class="box1">
                                <span class="li_stack"></span>
                                <h3><?= $data['active_categories_num'] ?></h3>
                            </div>
                            <p>Категорий каналов активно!</p>
                        </div>
                    </div>
                    <!-- /row mt -->

                    <?php if (isset($info['success'])) { ?>
                        <div class="alert alert-success edit_subj_result"><?= $info['success'] ?></div>
                    <?php }
                    if (isset($info['error'])) { ?>
                        <div class="alert alert-danger edit_subj_result"><b><?= $info['error'] ?></div>
                    <?php }
                    if (isset($info['warning'])) { ?>
                        <div class="alert alert-warning edit_subj_result"><?= $info['warning'] ?></div>
                    <?php } ?>


                    <!--CKEditor-->
                    <form method="post">
                        <textarea name="editor1" id="editor1" rows="10" cols="80">
                            This is my textarea to be replaced with CKEditor.
                        </textarea>
                        <div class="editor_submit">
                            <input type="submit" class="btn btn-lg btn-primary" value="Сохранить"/>
                        </div>
                        <script>
                            // Replace the <textarea id="editor1"> with a CKEditor
                            // instance, using default configuration.
                            CKEDITOR.replace('editor1');
                        </script>
                    </form>
                    <!--/CKEditor-->


                    <div class="row mt channels_table_cont table_cont table_cont_active">
                        <div class="col-md-12">
                            <div class="content-panel">
                                <table class="table table-striped table-advance table-hover channel_table">
                                    <h4><i class="fa fa-angle-right"></i>Каналы</h4>
                                    <hr>
                                    <thead>
                                    <tr>
                                        <th><i class="fa fa-bullhorn"></i> Ссылка</th>
                                        <th class="hidden-phone"><i class="fa fa-question-circle"></i> Название</th>
                                        <th><i class="fa fa-bookmark"></i> Описание</th>
                                        <th><i class="fa fa-bookmark"></i> Категория</th>
                                        <th><i class="fa fa-bookmark"></i> Участники</th>
                                        <th><i class="fa fa-bookmark"></i> Картинка</th>
                                        <th><i class="fa fa-bookmark"></i> Рейтинг</th>
                                        <th><i class=" fa fa-edit"></i> Статус</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach ($data['channels'] as $channel): ?>
                                        <tr class="channel_record">
                                            <td>
                                                <a href="<?= $channel['link'] ?>"
                                                   target="_blank"><?= mb_substr($channel['link'], strrpos($channel['link'], '/') + 1) ?></a>
                                            </td>
                                            <td><?= mb_substr($channel['title'], 0, 15) . '...' ?></td>
                                            <td><?= mb_substr($channel['description'], 0, 15) . '...' ?> </td>
                                            <td><?= $channel['category'] ?></td>
                                            <td><?= $channel['members'] ?></td>
                                            <td class="channel_img_table">
                                                <img src="/template/img/channels/<?= $channel['image'] ?>">
                                            </td>
                                            <td><?= $channel['rating'] ?></td>
                                            <td>
                                                <span class="label label-mini label-<?= $channel['status_class'] ?>"><?= $channel['status_description'] ?></span>
                                            </td>
                                            <td>
                                                <button data-toggle="modal" data-target="#modal_edit_channel"
                                                        class="btn btn-primary btn-xs edit_channel_btn"><i
                                                            class="fa fa-pencil"></i>
                                                </button>
                                                <button class="btn btn-danger btn-xs delete_channel_btn"><i
                                                            class="fa fa-trash-o "></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div><!-- /content-panel -->
                        </div><!-- /col-md-12 -->
                    </div><!-- /row -->

                    <div class="row mt bots_table_cont table_cont">
                        <div class="col-md-12">
                            <div class="content-panel">
                                <table class="table table-striped table-advance table-hover channel_table">
                                    <h4><i class="fa fa-angle-right"></i>Боты</h4>
                                    <hr>
                                    <thead>
                                    <tr>
                                        <th><i class="fa fa-bullhorn"></i> Ссылка</th>
                                        <th class="hidden-phone"><i class="fa fa-question-circle"></i> Username</th>
                                        <th><i class="fa fa-bookmark"></i> Название</th>
                                        <th><i class="fa fa-bookmark"></i> Описание</th>
                                        <th><i class="fa fa-bookmark"></i> Картинка</th>
                                        <th><i class="fa fa-bookmark"></i> Рейтинг</th>
                                        <th><i class=" fa fa-edit"></i> Статус</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach ($data['bots'] as $bot): ?>
                                        <tr class="bot_record">
                                            <td>
                                                <a href="<?= $bot['link'] ?>" target="_blank">
                                                    <?= mb_substr($bot['link'], strrpos($bot['link'], '/') + 1) ?>
                                                </a>
                                            </td>
                                            <td><?= $bot['username'] ?></td>
                                            <td><?= mb_substr($bot['title'], 0, 15) . '...' ?></td>
                                            <td><?= mb_substr($bot['description'], 0, 15) . '...' ?> </td>
                                            <td class="channel_img_table">
                                                <img src="/template/img/bots/<?= $bot['image'] ?>">
                                            </td>
                                            <td><?= $bot['rating'] ?></td>
                                            <td>
                                                <span class="label label-mini label-<?= $bot['status_class'] ?>"><?= $bot['status_description'] ?></span>
                                            </td>
                                            <td>
                                                <button data-toggle="modal" data-target="#modal_edit_bot"
                                                        class="btn btn-primary btn-xs edit_bot_btn"><i
                                                            class="fa fa-pencil"></i>
                                                </button>
                                                <button class="btn btn-danger btn-xs delete_bot_btn"><i
                                                            class="fa fa-trash-o "></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div><!-- /content-panel -->
                        </div><!-- /col-md-12 -->
                    </div><!-- /row -->

                    <div class="row mt articles_table_cont table_cont">
                        <div class="col-md-12">
                            <div class="content-panel">
                                <table class="table table-striped table-advance table-hover channel_table">
                                    <h4><i class="fa fa-angle-right"></i>Статьи</h4>
                                    <hr>
                                    <thead>
                                    <tr>
                                        <th><i class="fa fa-question-circle"></i> Название</th>
                                        <th><i class="fa fa-bookmark"></i> Содержание</th>
                                        <th><i class="fa fa-bookmark"></i> Дата публикации</th>
                                        <th><i class="fa fa-bookmark"></i> Картинка</th>
                                        <th><i class="fa fa-edit"></i> Статус</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach ($data['articles'] as $article): ?>
                                        <tr>
                                            <td><?= mb_substr($article['title'], 0, 15) . '...' ?></td>
                                            <td><?= mb_substr($article['content'], 0, 15) . '...' ?> </td>
                                            <td><?= $article['pub_date'] ?></td>
                                            <td class="channel_img_table">
                                                <img src="/template/img/articles/<?= $article['image'] ?>">
                                            </td>
                                            <td>
                                                <span class="label label-mini label-<?= $article['status_class'] ?>"><?= $article['status_description'] ?></span>
                                            </td>
                                            <td>
                                                <button data-toggle="modal" data-target="#modal_edit_article"
                                                        class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>
                                                </button>
                                                <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div><!-- /content-panel -->
                        </div><!-- /col-md-12 -->
                    </div><!-- /row -->

                    <div class="row mt stickers_table_cont table_cont">
                        <div class="col-md-12">
                            <div class="content-panel">
                                <table class="table table-striped table-advance table-hover channel_table">
                                    <h4><i class="fa fa-angle-right"></i>Стикеры</h4>
                                    <hr>
                                    <thead>
                                    <tr>
                                        <th class="hidden-phone"><i class="fa fa-question-circle"></i> Название</th>
                                        <th><i class="fa fa-bookmark"></i> Описание</th>
                                        <th><i class="fa fa-bookmark"></i> Картинка</th>
                                        <th><i class=" fa fa-edit"></i> Статус</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach ($data['stickers'] as $sticker): ?>
                                        <tr>
                                            <td><?= mb_substr($sticker['title'], 0, 15) . '...' ?></td>
                                            <td><?= mb_substr($sticker['description'], 0, 15) . '...' ?> </td>
                                            <td class="channel_img_table">
                                                <img src="/template/img/stickers/<?= $sticker['image'] ?>">
                                            </td>
                                            <td>
                                                <span class="label label-mini label-<?= $sticker['status_class'] ?>"><?= $sticker['status_description'] ?></span>
                                            </td>
                                            <td>
                                                <button data-toggle="modal" data-target="#modal_edit_sticker"
                                                        class="btn btn-primary btn-xs"><i class="fa fa-pencil"></i>
                                                </button>
                                                <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o "></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div><!-- /content-panel -->
                        </div><!-- /col-md-12 -->
                    </div><!-- /row -->

                    <div class="row mt categories_table_cont table_cont">
                        <div class="col-md-12">
                            <div class="content-panel">
                                <table class="table table-striped table-advance table-hover channel_table">
                                    <h4><i class="fa fa-angle-right"></i>Категории каналов</h4>
                                    <hr>
                                    <thead>
                                    <tr>
                                        <th class="hidden-phone"><i class="fa fa-question-circle"></i> Название</th>
                                        <th><i class="fa fa-bookmark"></i> Картинка</th>
                                        <th><i class=" fa fa-edit"></i> Статус</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    <?php foreach ($data['channel_categories'] as $category): ?>
                                        <tr>
                                            <td><?= $category['title'] ?></td>
                                            <td class="channel_img_table">
                                                <img src="/template/img/categories/<?= $category['image'] ?>">
                                            </td>
                                            <td>
                                                <span class="label label-mini label-<?= $category['status_class'] ?>"><?= $category['status_description'] ?></span>
                                            </td>
                                            <td>
                                                <button data-toggle="modal" data-target="#modal_edit_category"
                                                        class="btn btn-primary btn-xs edit_category_btn"><i
                                                            class="fa fa-pencil"></i>
                                                </button>
                                                <button class="btn btn-danger btn-xs delete_category_btn"><i
                                                            class="fa fa-trash-o "></i>
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div><!-- /content-panel -->
                        </div><!-- /col-md-12 -->
                    </div><!-- /row -->

                </div><!-- /col-lg-9 END SECTION MIDDLE -->


                <!-- **********************************************************************************************************************************************************
                RIGHT SIDEBAR CONTENT
                *********************************************************************************************************************************************************** -->

                <div class="col-lg-3 ds">
                    <!--COMPLETED ACTIONS DONUTS CHART-->
                    <h3>NOTIFICATIONS</h3>
                    <!-- First Action -->
                    <div class="desc">
                        <div class="thumb">
                            <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <div class="details">
                            <p>
                                <muted>2 Minutes Ago</muted>
                                <br/>
                                <a href="#">James Brown</a> subscribed to your newsletter.<br/>
                            </p>
                        </div>
                    </div>
                    <div class="desc">
                        <div class="thumb">
                            <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <div class="details">
                            <p>
                                <muted>2 Minutes Ago</muted>
                                <br/>
                                <a href="#">James Brown</a> subscribed to your newsletter.<br/>
                            </p>
                        </div>
                    </div>
                    <div class="desc">
                        <div class="thumb">
                            <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <div class="details">
                            <p>
                                <muted>2 Minutes Ago</muted>
                                <br/>
                                <a href="#">James Brown</a> subscribed to your newsletter.<br/>
                            </p>
                        </div>
                    </div>
                    <div class="desc">
                        <div class="thumb">
                            <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <div class="details">
                            <p>
                                <muted>2 Minutes Ago</muted>
                                <br/>
                                <a href="#">James Brown</a> subscribed to your newsletter.<br/>
                            </p>
                        </div>
                    </div>
                    <!-- Second Action -->
                    <div class="desc">
                        <div class="thumb">
                            <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <div class="details">
                            <p>
                                <muted>3 Hours Ago</muted>
                                <br/>
                                <a href="#">Diana Kennedy</a> purchased a year subscription.<br/>
                            </p>
                        </div>
                    </div>
                    <!-- Third Action -->
                    <div class="desc">
                        <div class="thumb">
                            <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <div class="details">
                            <p>
                                <muted>7 Hours Ago</muted>
                                <br/>
                                <a href="#">Brandon Page</a> purchased a year subscription.<br/>
                            </p>
                        </div>
                    </div>
                    <!-- Fourth Action -->
                    <div class="desc">
                        <div class="thumb">
                            <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <div class="details">
                            <p>
                                <muted>11 Hours Ago</muted>
                                <br/>
                                <a href="#">Mark Twain</a> commented your post.<br/>
                            </p>
                        </div>
                    </div>
                    <!-- Fifth Action -->
                    <div class="desc">
                        <div class="thumb">
                            <span class="badge bg-theme"><i class="fa fa-clock-o"></i></span>
                        </div>
                        <div class="details">
                            <p>
                                <muted>18 Hours Ago</muted>
                                <br/>
                                <a href="#">Daniel Pratt</a> purchased a wallet in your store.<br/>
                            </p>
                        </div>
                    </div>
                    <!-- CALENDAR-->
                    <div id="calendar" class="mb">
                        <div class="panel green-panel no-margin">
                            <div class="panel-body">
                                <div id="date-popover" class="popover top"
                                     style="cursor: pointer; disadding: block; margin-left: 33%; margin-top: -50px; width: 175px;">
                                    <div class="arrow"></div>
                                    <h3 class="popover-title" style="disadding: none;"></h3>
                                    <div id="date-popover-content" class="popover-content"></div>
                                </div>
                                <div id="my-calendar"></div>
                            </div>
                        </div>
                    </div><!-- / calendar -->

                </div><!-- /col-lg-3 -->
            </div>
            <! --/row -->
        </section>
    </section>

    <!--main content end-->
    <!--footer start-->
    <footer class="site-footer">
        <div class="text-center">
            2017 - Delari
            <a href="javacsript:;" class="go-top">
                <i class="fa fa-angle-up"></i>
            </a>
        </div>
    </footer>
    <!--footer end-->
</section>

<!-- js placed at the end of the document so the pages load faster -->
<script src="/views/admin/assets/js/jquery.js"></script>
<script src="/views/admin/assets/js/jquery-1.8.3.min.js"></script>
<script src="/views/admin/assets/js/bootstrap.min.js"></script>
<script class="include" type="text/javascript" src="/views/admin/assets/js/jquery.dcjqaccordion.2.7.js"></script>
<script src="/views/admin/assets/js/jquery.scrollTo.min.js"></script>
<script src="/views/admin/assets/js/jquery.nicescroll.js" type="text/javascript"></script>
<script src="/views/admin/assets/js/jquery.sparkline.js"></script>


<!--common script for all pages-->
<script src="/views/admin/assets/js/common-scripts.js"></script>

<script type="text/javascript" src="/views/admin/assets/js/gritter/js/jquery.gritter.js"></script>
<script type="text/javascript" src="/views/admin/assets/js/gritter-conf.js"></script>

<!--script for this page-->
<script src="/views/admin/assets/js/sparkline-chart.js"></script>
<script src="/views/admin/assets/js/zabuto_calendar.js"></script>

<!--script for editing subjects-->
<script src="/template/js/js-realst.js"></script>

<script type="text/javascript">
    $(document).ready(function () {
        var unique_id = $.gritter.add({
            // (string | mandatory) the heading of the notification
            title: 'Добро пожаловать!',
            // (string | mandatory) the text inside the notification
            text: 'Управляйте сожержимым сайта в админ-панели одним кликом!',
            // (string | optional) the image to display on the left
            image: '/views/admin/assets/img/ui-sam.jpg',
            // (bool | optional) if you want it to fade out on its own or just sit there
            sticky: false,
            // (int | optional) the time you want it to be alive for before fading out
            time: 3000,
            // (string | optional) the class name you want to apply to that specific message
            class_name: 'my-sticky-class'
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


//        Menu action
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
//        /Menu action

        return false;
    });
</script>

<script type="application/javascript">
    $(document).ready(function () {
        $("#date-popover").popover({html: true, trigger: "manual"});
        $("#date-popover").hide();
        $("#date-popover").click(function (e) {
            $(this).hide();
        });

        $("#my-calendar").zabuto_calendar({
            action: function () {
                return myDateFunction(this.id, false);
            },
            action_nav: function () {
                return myNavFunction(this.id);
            },
            ajax: {
                url: "show_data.php?action=1",
                modal: true
            },
            legend: [
                {type: "text", label: "Special event", badge: "00"},
                {type: "block", label: "Regular event",}
            ]
        });
    });


    function myNavFunction(id) {
        $("#date-popover").hide();
        var nav = $("#" + id).data("navigation");
        var to = $("#" + id).data("to");
        console.log('nav ' + nav + ' to: ' + to.month + '/' + to.year);
    }
</script>

</body>
</html>
