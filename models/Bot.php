<?php

/**
 * Created by PhpStorm.
 * User: Nikitin Dima
 * Date: 20.04.2017
 * Time: 18:57
 */
class Bot extends Model
{
    public function get_data()
    {
        $data = array();

        if (Data::isSetPostParameter("offer_bot_submit") && !isset($_SESSION['secret_offer_bot'])) {
            $_SESSION['secret_offer_bot'] = 0;
        }

        if (Data::isSetPostParameter("offer_bot_submit") && $_SESSION['secret_offer_bot'] !== Data::getPostParameter('secret_offer_bot')) {
            $_SESSION['secret_offer_bot'] = Data::getPostParameter('secret_offer_bot');

            $data['link'] = Data::getPostParameter("bot_link");
            $data['title'] = Data::getPostParameter("bot_title");
            $data['description'] = Data::getPostParameter("bot_description");
            $data['extra_info'] = Data::getPostParameter("bot_extra_info");
            $data['username'] = Data::getPostParameter("bot_username");
            $is_data_valid = static::check_data($data['link'], $data['title'], $data['description'], $data['username'], true, true);

            if ($is_data_valid == 'ok') {
                $data['is_offer'] = true;
                $_SESSION['secret_offer_bot'] = $_SESSION['secret_offer_bot'] . 1;
            } else {
                $data['error'] = $is_data_valid;
            }
        }

        $data['bots'] = static::get_bots(true);

        return $data;
    }

    /**
     * Checks data before adding to DB
     *
     * @param $link - link of the bot
     * @param $title - title of the bot
     * @param $description - description of the bot
     * @param $username - username of the bot
     * @param $is_new_link - has been link of bot changed
     * @param $is_new_username - has been username of bot changed
     *
     * @return string - 'ok' if correct data or error description if invalid data
     */
    public static function check_data($link, $title, $description, $username, $is_new_link, $is_new_username)
    {
        if ($is_new_link) {
            if (static::get_bot_by_link($link)['id']) {
                return "Бот с такой ссылкой уже существует!";
            }
        }

        if (mb_strlen($link) == 0) {
            return 'Ссылка не может быть пустой!';
        }

        if (strpos($link, " ") !== false) {
            return 'Ссылка не может содержать пробелы!';
        }

        if (mb_strlen($username) == 0 || mb_strlen($username) > 90) {
            return 'Длина username бота может быть от 1 до 90 символов!';
        }

        if (strpos($username, " ") !== false) {
            return 'Username не может содержать пробелы!';
        }

        if ($is_new_username) {
            if (static::get_bot_by_username($username)['id']) {
                return "Бот с таким username уже существует!";
            }
        }

        if (mb_strlen($title) == 0 || mb_strlen($title) > 50) {
            return 'Длина названия может быть от 1 до 50 символов!';
        }

        if (mb_strlen($description) == 0 || mb_strlen($description) > 200) {
            return 'Длина описания может быть от 1 до 200 символов!';
        }

        return 'ok';
    }

    /**
     * Gets information about bot by its link
     *
     * @param $link - link of the bot
     *
     * @return array - information about bot
     */
    public static function get_bot_by_link($link)
    {
        $sql = 'SELECT * FROM `bots` WHERE `link` = :link';
        $result = $GLOBALS['DBH']->prepare($sql);

        $result->bindParam(':link', $link, PDO::PARAM_STR);
        $result->execute();

        return $row = $result->fetch();
    }

    /**
     * Gets information about bot by its username
     *
     * @param $username - username of the bot
     *
     * @return array - information about bot
     */
    private static function get_bot_by_username($username)
    {
        $sql = 'SELECT * FROM `bots` WHERE `username` = :username';
        $result = $GLOBALS['DBH']->prepare($sql);

        $result->bindParam(':username', $username, PDO::PARAM_STR);
        $result->execute();

        return $row = $result->fetch();
    }

    /**
     * Returns information about bots
     *
     * @param $active_only - return only active or all
     *
     * @return array - information about bots
     */
    public static function get_bots($is_active_only)
    {
        $sql = 'SELECT * FROM `bots`';

        if ($is_active_only) {
            $sql .= ' WHERE `status` = 1 ORDER BY `rating` DESC';
        }

        $result = $GLOBALS['DBH']->query($sql);
        $bots = array();
        $i = 0;

        while ($row = $result->fetch()) {
            $bots[$i] = $row;

            switch ($bots[$i]['status']) {
                case 0:
                    $bots[$i]['status_class'] = 'warning';
                    $bots[$i]['status_description'] = 'Запрос';
                    break;
                case 1:
                    $bots[$i]['status_class'] = 'success';
                    $bots[$i]['status_description'] = 'Активна';
                    break;
                case 2:
                    $bots[$i]['status_class'] = 'danger';
                    $bots[$i]['status_description'] = 'Неактивна';
                    break;
            }

            $i++;
        }

        return $bots;
    }

    public static function edit_bot($link, $username, $title, $description, $rating, $extra_info, $status, $image, $old_link)
    {
        $sql = 'UPDATE `bots` SET `link` = :link, `username` = :username, `title` = :title, 
                `description` = :description, `rating` = :rating, `extra_info` = :extra_info, `status` = :status';

        if ($image !== null) {
            $sql .= ', `image` = :image';
        }

        $sql .= ' WHERE `link` = :old_link';
        $result = $GLOBALS['DBH']->prepare($sql);

        $result->bindParam(':link', $link, PDO::PARAM_STR);
        $result->bindParam(':username', $username, PDO::PARAM_STR);
        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':rating', $rating, PDO::PARAM_STR);
        $result->bindParam(':extra_info', $extra_info, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_STR);
        $result->bindParam(':old_link', $old_link, PDO::PARAM_STR);

        if ($image !== null) {
            $result->bindParam(':image', $image, PDO::PARAM_STR);
        }

        $result->execute();
        return $result->rowCount() != 0;
    }
}