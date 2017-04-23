<?php

/**
 * Created by PhpStorm.
 * User: Nikitin Dima
 * Date: 20.04.2017
 * Time: 19:34
 */
class Admin
{
    public function get_data()
    {
        $data = array();

        if (Data::isSetPostParameter("edit_channel_submit") && !isset($_SESSION['secret_edit_channel'])) {
            $_SESSION['secret_edit_channel'] = 0;
        }

        if (Data::isSetPostParameter("edit_bot_submit") && !isset($_SESSION['secret_edit_bot'])) {
            $_SESSION['secret_edit_bot'] = 0;
        }

        if (Data::isSetPostParameter("edit_article_submit") && !isset($_SESSION['secret_edit_article'])) {
            $_SESSION['secret_edit_article'] = 0;
        }

        if (Data::isSetPostParameter("edit_sticker_submit") && !isset($_SESSION['secret_edit_sticker'])) {
            $_SESSION['secret_edit_sticker'] = 0;
        }

        if (Data::isSetPostParameter("edit_category_submit") && !isset($_SESSION['secret_edit_category'])) {
            $_SESSION['secret_edit_category'] = 0;
        }


        if (Data::isSetPostParameter('edit_channel_submit') && $_SESSION['secret_edit_channel'] !== Data::getPostParameter('secret_edit_channel')) {
            $_SESSION['secret_edit_channel'] = Data::getPostParameter('secret_edit_channel');

            $data['link'] = Data::getPostParameter("channel_link");
            $data['channel_id'] = Channel::get_channel($_SESSION['old_link_channel'])['id'];
            $data['title'] = Data::getPostParameter("channel_title");
            $data['description'] = Data::getPostParameter("channel_description");
            $data['category'] = Channel::get_category_by_title(Data::getPostParameter("channel_category"))['id'];
            $data['members'] = Data::getPostParameter("channel_members");
            $data['rating'] = Data::getPostParameter("channel_rating");
            $data['status'] = !Data::getPostParameter("channel_status") ? 2 : 1;
            $data['extra_info'] = Data::getPostParameter("channel_extra_info");
            $data['is_valid_channel'] = true;

            if (!$data['channel_id']) {
                $data['is_valid_channel'] = false;
                $data['error'] = "Произошла ошибка. Попробуйте позже";
                return $data;
            }

            $is_data_valid = Channel::check_data($data['link'], Data::getPostParameter("channel_category"), $data['title'], $_SESSION['old_link_channel'] !== $data['link']);

            if ($is_data_valid !== 'ok') {
                $data['is_valid_channel'] = false;
                $data['error'] = $is_data_valid;
            }

            $_SESSION['secret_edit_channel'] = $_SESSION['secret_edit_channel'] . 1;

            return $data;
        }

        if (Data::isSetPostParameter('edit_bot_submit') && $_SESSION['secret_edit_bot'] !== Data::getPostParameter('secret_edit_bot')) {
            $_SESSION['secret_edit_bot'] = Data::getPostParameter('secret_edit_bot');

            $data['link'] = Data::getPostParameter("bot_link");
            $data['bot_id'] = Bot::get_bot_by_link($_SESSION['old_link_bot'])['id'];
            $data['username'] = Data::getPostParameter("bot_username");
            $data['title'] = Data::getPostParameter("bot_title");
            $data['description'] = Data::getPostParameter("bot_description");
            $data['rating'] = Data::getPostParameter("bot_rating");
            $data['status'] = !Data::getPostParameter("bot_status") ? 2 : 1;
            $data['extra_info'] = Data::getPostParameter("bot_extra_info");
            $data['is_valid_bot'] = true;

            if (!$data['bot_id']) {
                $data['is_valid_bot'] = false;
                $data['error'] = "Произошла ошибка. Попробуйте позже";
                return $data;
            }

            $is_data_valid = Bot::check_data($data['link'], $data['title'], $data['description'], $data['username'],
                $_SESSION['old_link_bot'] !== $data['link'], $_SESSION['old_username_bot'] !== $data['username']);

            if ($is_data_valid !== 'ok') {
                $data['is_valid_bot'] = false;
                $data['error'] = $is_data_valid;
            }

            $_SESSION['secret_edit_bot'] = $_SESSION['secret_edit_bot'] . 1;

            return $data;
        }

        if (Data::isSetPostParameter('edit_article_submit') && $_SESSION['secret_edit_article'] !== Data::getPostParameter('secret_edit_article')) {
            $_SESSION['secret_edit_article'] = Data::getPostParameter('secret_edit_article');


        }

        if (Data::isSetPostParameter('edit_sticker_submit') && $_SESSION['secret_edit_sticker'] !== Data::getPostParameter('secret_edit_sticker')) {
            $_SESSION['secret_edit_sticker'] = Data::getPostParameter('secret_edit_sticker');


        }

        if (Data::isSetPostParameter('edit_category_submit') && $_SESSION['secret_edit_category'] !== Data::getPostParameter('secret_edit_category')) {
            $_SESSION['secret_edit_category'] = Data::getPostParameter('secret_edit_category');

            $data['title'] = Data::getPostParameter("category_title");
            $data['category_id'] = Channel::get_category_by_title($_SESSION['old_title_category'])['id'];
            $data['status'] = !Data::getPostParameter("category_status") ? 2 : 1;
            $data['is_valid_category'] = true;

            if (!$data['category_id']) {
                $data['is_valid_category'] = false;
                $data['error'] = "Произошла ошибка. Попробуйте позже";
                return $data;
            }

            $is_data_valid = Channel::check_category($data['title'], $_SESSION['old_title_category'] !== $data['title']);

            if ($is_data_valid !== 'ok') {
                $data['is_valid_category'] = false;
                $data['error'] = $is_data_valid;
            }

            $_SESSION['secret_edit_category'] = $_SESSION['secret_edit_category'] . 1;

            return $data;
        }
    }

    /**
     * Returns information about all subjects
     *
     * @return array - information about all subjects
     */
    public function get_subjects_info()
    {
        $data = array();

        $data['mail'] = Data::getPostParameter("admin_mail");
        $data['password'] = Data::getPostParameter("admin_password");
        $data['hash'] = $this->gen_hash();
        $data['admin'] = static::get_admin_by_id(Data::getCookieParameter('id'));
        $data['channels'] = Channel::get_channels(false);
        $data['active_channels_num'] = Data::get_num_of_active_subjects(0);
        $data['channel_categories'] = Channel::get_categories();
        $data['active_categories_num'] = Data::get_num_of_active_subjects(4);
        $data['bots'] = Bot::get_bots(false);
        $data['active_bots_num'] = Data::get_num_of_active_subjects(1);
        $data['articles'] = Article::get_articles();
        $data['active_articles_num'] = Data::get_num_of_active_subjects(2);
        $data['stickers'] = Sticker::get_stickers();
        $data['active_stickers_num'] = Data::get_num_of_active_subjects(3);

        return $data;
    }

    /**
     * Generates hash for user authorizateion
     *
     * @param int $length - length of the hash
     *
     * @return string - generated hash
     */
    private function gen_hash($length = 60)
    {
        $length %= 61;
        $length = abs($length);

        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPRQSTUVWXYZ0123456789";
        $code = "";
        $clen = strlen($chars) - 1;

        while (strlen($code) < $length) {
            $code .= $chars[mt_rand(0, $clen)];
        }

        return $code;
    }

    /**
     * Checks whether user is admin
     *
     * @return bool - result of checking
     */
    public static function is_admin_logged()
    {
        if (Data::isSetCookieParameter("id") && Data::isSetCookieParameter("hash")) {
            $id = Data::getCookieParameter("id");
            $hash = Data::getCookieParameter("hash");
            $admin = static::get_admin_by_id($id);

            if (isset($admin['hash']) && $admin['hash'] == $hash) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * Returns admin by email
     *
     * @param $email - admin's email
     *
     * @return mixed - array of information about admin
     */
    public static function get_admin_by_email($email)
    {
        $sql = 'SELECT * FROM `admins` WHERE `email` = :email';
        $result = $GLOBALS['DBH']->prepare($sql);

        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->execute();

        $row = $result->fetch();

        return $row;
    }

    /**
     * Returns admin by email
     *
     * @param $id - admin's id
     *
     * @return mixed - array of information about admin
     */
    public static function get_admin_by_id($id)
    {
        $sql = 'SELECT * FROM `admins` WHERE `id` = :id';
        $result = $GLOBALS['DBH']->prepare($sql);

        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->execute();

        $row = $result->fetch();

        return $row;
    }
}