<?php
/**
 * Created by PhpStorm.
 * User: Nikitin Dima
 * Date: 23.04.2017
 * Time: 2:54
 */

session_start();
require_once 'core/Model.php';
require_once 'models/Data.php';
require_once 'models/Channel.php';
require_once 'models/Bot.php';
require_once 'models/Main.php';
require_once 'models/Sticker.php';
require_once 'models/Article.php';
require_once 'components/DB.php';
$params = include('config/db_params.php');
$GLOBALS['DBH'] = DB::getConnection($params);
$GLOBALS['DBH']->exec("SET NAMES utf8");

if ($_POST['purpose'] === 'edit_channel') {
    $old_link = Data::getPostParameter('channel_old_link');
    $_SESSION['old_link_channel'] = $old_link;
    $channel = Channel::get_channel($old_link);
    $channel['category'] = Channel::get_category_by_id($channel['category_id'])['title'];

    if (!$channel['id']) {
        echo 'error';
    } else {
        echo json_encode($channel);
    }
}

if ($_POST['purpose'] === 'delete_channel') {
    $old_link = Data::getPostParameter('channel_old_link');

    $sql = 'DELETE FROM `channels` WHERE `link` = :link';
    $result = $GLOBALS['DBH']->prepare($sql);

    $result->bindParam(':link', $old_link, PDO::PARAM_STR);
    $result->execute();

    if ($result->rowCount() != 0) {
        echo 'ok';
        return;
    }

    echo 'error';
}

if ($_POST['purpose'] === 'edit_bot') {
    $old_link = Data::getPostParameter('bot_old_link');
    $old_username = Data::getPostParameter('bot_old_username');
    $_SESSION['old_link_bot'] = $old_link;
    $_SESSION['old_username_bot'] = $old_username;
    $bot = Bot::get_bot_by_link($old_link);

    if (!$bot['id']) {
        echo 'error';
    } else {
        echo json_encode($bot);
    }
}

if ($_POST['purpose'] === 'delete_bot') {
    $old_link = Data::getPostParameter('bot_old_link');

    $sql = 'DELETE FROM `bots` WHERE `link` = :link';
    $result = $GLOBALS['DBH']->prepare($sql);

    $result->bindParam(':link', $old_link, PDO::PARAM_STR);
    $result->execute();

    if ($result->rowCount() != 0) {
        echo 'ok';
        return;
    }

    echo 'error';
}

if ($_POST['purpose'] === 'edit_category') {
    $old_title = Data::getPostParameter('category_old_title');
    $_SESSION['old_title_category'] = $old_title;
    $category = Channel::get_category_by_title($old_title);

    if (!$category['id']) {
        echo 'error';
    } else {
        echo json_encode($category);
    }
}

if ($_POST['purpose'] === 'delete_category') {
    $old_title = Data::getPostParameter('category_old_title');

    $sql = 'DELETE FROM `channel_categories` WHERE `title` = :title';
    $result = $GLOBALS['DBH']->prepare($sql);

    $result->bindParam(':title', $old_title, PDO::PARAM_STR);
    $result->execute();

    if ($result->rowCount() != 0) {
        echo 'ok';
        return;
    }

    echo 'error';
}

if ($_POST['purpose'] === 'edit_content_text') {
    $element_id = Data::getPostParameter('element_id');
    $new_content = Data::getPostParameter('new_content');

    $page_element = Main::get_page_element_by_id($element_id);

    if (!$page_element['id']) {
        echo 'error';
        return;
    }

    if (mb_strlen($new_content) > $page_element['max_size']) {
        echo 'error';
        return;
    }

    $sql = 'UPDATE `page_elements` SET `code` = :new_content WHERE `id` = :element_id';
    $result = $GLOBALS['DBH']->prepare($sql);

    $result->bindParam(':new_content', $new_content, PDO::PARAM_STR);
    $result->bindParam(':element_id', $page_element['id'], PDO::PARAM_STR);
    $result->execute();

    if ($result->rowCount() != 0) {
        echo 'ok';
        return;
    }

    echo 'error';
}

if ($_POST['purpose'] === 'edit_content_image') {
    $element_id = Data::getPostParameter('element_id');
    $page_element = Main::get_page_element_by_id($element_id);

    if (!$page_element['id']) {
        echo 'error';
        return;
    }

    if (!$_FILES['img']['tmp_name']) {
        echo 'error';
        return;
    }

    $extension = strtolower(pathinfo($_FILES['img']['name'], PATHINFO_EXTENSION));

    if ($extension !== 'jpg' && $extension !== 'png') {
        echo 'error';
        return;
    }

    $started_path = mb_substr($page_element['code'], 0, mb_strrpos($page_element['code'], '.'));
    $old_extension = mb_substr($page_element['code'], mb_strrpos($page_element['code'], '.') + 1);
    $new_name = $started_path . '.' . $extension;

    if (!is_uploaded_file($_FILES['img']["tmp_name"]) || !move_uploaded_file($_FILES['img']['tmp_name'], mb_substr($new_name, 1))) {
        echo 'error';
        return;
    }

    if ($extension !== $old_extension) {
        $sql = 'UPDATE `page_elements` SET `code` = :new_image WHERE `id` = :element_id';
        $result = $GLOBALS['DBH']->prepare($sql);

        $result->bindParam(':new_image', $new_name, PDO::PARAM_STR);
        $result->bindParam(':element_id', $page_element['id'], PDO::PARAM_STR);
        $result->execute();

        if ($result->rowCount() != 0) {
            echo 'ok';
            return;
        } else {
            echo 'error';
        }
    }

    echo 'ok';
}

if ($_POST['purpose'] === 'get_old_content') {
    $element_id = Data::getPostParameter('element_id');
    $element = Main::get_page_element_by_id($element_id);

    if (!$element['id']) {
        echo "error";
    } else {
        echo json_encode($element);
    }
}


if ($_POST['purpose'] === 'edit_sticker') {
    $old_title = Data::getPostParameter('sticker_old_title');
    $_SESSION['old_title_sticker'] = $old_title;
    $sticker = Sticker::get_sticker_by_title($old_title);

    if (!$sticker['id']) {
        echo 'error';
    } else {
        echo json_encode($sticker);
    }
}

if ($_POST['purpose'] === 'delete_sticker') {
    $old_title = Data::getPostParameter('sticker_old_title');

    $sql = 'DELETE FROM `stickers` WHERE `title` = :title';
    $result = $GLOBALS['DBH']->prepare($sql);

    $result->bindParam(':title', $old_title, PDO::PARAM_STR);
    $result->execute();

    if ($result->rowCount() != 0) {
        echo 'ok';
        return;
    }

    echo 'error';
}


if ($_POST['purpose'] === 'edit_article') {
    $old_title = Data::getPostParameter('article_old_title');
    $_SESSION['old_title_article'] = $old_title;
    $article = Article::get_article_by_title($old_title);

    if (!$article['id']) {
        echo 'error';
    } else {
        echo json_encode($article);
    }
}

if ($_POST['purpose'] === 'delete_article') {
    $old_title = Data::getPostParameter('article_old_title');

    $sql = 'DELETE FROM `articles` WHERE `title` = :title';
    $result = $GLOBALS['DBH']->prepare($sql);

    $result->bindParam(':title', $old_title, PDO::PARAM_STR);
    $result->execute();

    if ($result->rowCount() != 0) {
        echo 'ok';
        return;
    }

    echo 'error';
}