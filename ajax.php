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
require_once 'components/DB.php';
require_once 'models/Bot.php';
$params = include('config/db_params.php');
$GLOBALS['DBH'] = DB::getConnection($params);

if ($_POST['purpose'] == 'edit_channel') {
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

if ($_POST['purpose'] == 'delete_channel') {
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

if ($_POST['purpose'] == 'edit_bot') {
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

if ($_POST['purpose'] == 'delete_bot') {
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

if ($_POST['purpose'] == 'edit_category') {
    $old_title = Data::getPostParameter('category_old_title');
    $_SESSION['old_title_category'] = $old_title;
    $category = Channel::get_category_by_title($old_title);

    if (!$category['id']) {
        echo 'error';
    } else {
        echo json_encode($category);
    }
}

if ($_POST['purpose'] == 'delete_category') {
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