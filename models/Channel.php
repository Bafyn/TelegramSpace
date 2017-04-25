<?php

/**
 * Created by PhpStorm.
 * User: Nikitin Dima
 * Date: 20.04.2017
 * Time: 18:57
 */
class Channel extends Model
{
    public function get_data()
    {
        $data = array();

        if (Data::isSetGetParameter('category')) {
            $data['current_category'] = static::get_category_by_id(Data::getGetParameter('category'));
            if ($data['current_category']) {
                $data['is_valid_category'] = true;
                $data['category_channels'] = $this->get_channels_by_category(Data::getGetParameter('category'));
            } else {
                $data['is_valid_category'] = false;
            }
        } else {
            $data['is_valid_category'] = false;
        }

        if (Data::isSetPostParameter("offer_channel_submit") && !isset($_SESSION['secret_offer_channel'])) {
            $_SESSION['secret_offer_channel'] = 0;
        }

        if (Data::isSetPostParameter("offer_channel_submit") && $_SESSION['secret_offer_channel'] !== Data::getPostParameter('secret_offer_channel')) {
            $_SESSION['secret_offer_channel'] = Data::getPostParameter('secret_offer_channel');

            $data['link'] = Data::getPostParameter("channel_link");
            $data['category'] = static::get_category_by_title(Data::getPostParameter("channel_category"))['id'];
            $data['title'] = Data::getPostParameter("channel_title");
            $data['description'] = Data::getPostParameter("channel_description");
            $data['extra_info'] = Data::getPostParameter("channel_extra_info");
            $is_data_valid = static::check_data($data['link'], Data::getPostParameter("channel_category"), $data['title'], true);

            if ($is_data_valid === 'ok') {
                $data['is_offer'] = true;
                $_SESSION['secret_offer_channel'] = $_SESSION['secret_offer_channel'] . 1;
            } else {
                $data['error'] = $is_data_valid;
            }
        }

        $data['categories'] = static::get_categories(true);

        return $data;
    }

    /**
     * Checks data before adding to DB
     *
     * @param $link - link of the channel
     * @param $category - category of the channel
     * @param $title - title of the channel
     * @param $is_new_link - has been link of channel changed
     *
     * @return string - 'ok' if correct data or error description if invalid data
     */
    public static function check_data($link, $category, $title, $is_new_link)
    {
        if ($is_new_link) {
            if (static::get_channel($link)['id']) {
                return "Канал с такой ссылкой уже существует!";
            }
        }

        if (mb_strlen($link) == 0) {
            return 'Ссылка не может быть пустой!';
        }

        if (strpos($link, " ") !== false) {
            return 'Ссылка не может содержать пробелы!';
        }

        if (!static::get_category_by_title($category)['id']) {
            return 'Выберите существующую категорию!';
        }

        if (mb_strlen($title) == 0 || mb_strlen($title) > 30) {
            return 'Длина названия должна быть от 0 до 30 символов!';
        }

        return 'ok';
    }

    /**
     * Gets id of the category by its title
     *
     * @param $title - title of the category
     *
     * @return mixed - id of the category
     */
    public static function get_category_by_title($title)
    {
        $sql = 'SELECT * FROM `channel_categories` WHERE `title` = :title';
        $result = $GLOBALS['DBH']->prepare($sql);

        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->execute();

        return $row = $result->fetch();
    }

    public static function get_category_by_id($category_id)
    {
        $sql = 'SELECT * FROM `channel_categories` WHERE `id` = :id';
        $result = $GLOBALS['DBH']->prepare($sql);

        $result->bindParam(':id', $category_id, PDO::PARAM_STR);
        $result->execute();

        $row = $result->fetch();

        return $row;
    }

    /**
     * Gets channel by its link
     *
     * @param $link - link of the channel
     *
     * @return array - information about channel
     */
    public static function get_channel($link)
    {
        $sql = 'SELECT * FROM `channels` WHERE `link` = :link';
        $result = $GLOBALS['DBH']->prepare($sql);

        $result->bindParam(':link', $link, PDO::PARAM_STR);
        $result->execute();

        return $row = $result->fetch();
    }

    /**
     * Gets all channel categories
     *
     * @return array - information about categories
     */
    public static function get_categories($is_only_active)
    {
        $sql = 'SELECT * FROM `channel_categories`';

        if ($is_only_active) {
            $sql .= ' WHERE `status` = 1';
        }

        $result = $GLOBALS['DBH']->query($sql);
        $categories = array();
        $i = 0;

        while ($row = $result->fetch()) {
            $categories[$i] = $row;

            switch ($categories[$i]['status']) {
                case 1:
                    $categories[$i]['status_class'] = 'success';
                    $categories[$i]['status_description'] = 'Активна';
                    break;
                case 2:
                    $categories[$i]['status_class'] = 'danger';
                    $categories[$i]['status_description'] = 'Неактивна';
                    break;
            }

            $i++;
        }

        return $categories;
    }

    /**
     * Returns information about channels
     *
     * @param $active_only - return only active or all
     *
     * @return array - information about channels
     */
    public static function get_channels($active_only)
    {
        $sql = 'SELECT * FROM `channels`';

        if ($active_only) {
            $sql .= ' WHERE `status` = 1 ORDER BY `rating`';
        }

        $result = $GLOBALS['DBH']->query($sql);
        $channels = array();
        $i = 0;

        while ($row = $result->fetch()) {
            $channels[$i] = $row;
            $channels[$i]['category'] = static::get_category_by_id($row['category_id'])['title'];

            switch ($channels[$i]['status']) {
                case 0:
                    $channels[$i]['status_class'] = 'warning';
                    $channels[$i]['status_description'] = 'Запрос';
                    break;
                case 1:
                    $channels[$i]['status_class'] = 'success';
                    $channels[$i]['status_description'] = 'Активна';
                    break;
                case 2:
                    $channels[$i]['status_class'] = 'danger';
                    $channels[$i]['status_description'] = 'Неактивна';
                    break;
            }

            $i++;
        }

        return $channels;
    }

    /**
     * Returns channels of particular category
     *
     * @param $category_id - id of the category
     *
     * @return array - information about channels
     */
    private function get_channels_by_category($category_id)
    {
        $sql = 'SELECT * FROM `channels` WHERE `category_id` = :category_id  AND `status` = 1 ORDER BY `rating`';
        $result = $GLOBALS['DBH']->prepare($sql);

        $result->bindParam(':category_id', $category_id, PDO::PARAM_STR);
        $result->execute();

        $channels = array();
        $i = 0;

        while ($row = $result->fetch()) {
            $channels[$i] = $row;
            $i++;
        }

        return $channels;
    }

    public static function edit_channel($link, $title, $description, $category, $members, $rating, $extra_info, $status, $image, $old_link)
    {
        $sql = 'UPDATE `channels` SET `link` = :link, `title` = :title, `description` = :description, 
                `category_id` = :category, `members` = :members, `rating` = :rating, 
                `extra_info` = :extra_info, `status` = :status';

        if ($image !== null) {
            $sql .= ', `image` = :image';
        }

        $sql .= ' WHERE `link` = :old_link';
        $result = $GLOBALS['DBH']->prepare($sql);

        $result->bindParam(':link', $link, PDO::PARAM_STR);
        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':category', $category, PDO::PARAM_STR);
        $result->bindParam(':members', $members, PDO::PARAM_STR);
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

    public static function add_channel_category($title, $image, $status)
    {
        $sql = "INSERT INTO `channel_categories` VALUES (NULL, :title";

        if ($image !== null) {
            $sql .= ', :image';
        }

        $sql .= ', :status)';
        $result = $GLOBALS['DBH']->prepare($sql);

        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_STR);

        if ($image !== null) {
            $result->bindParam(':image', $image, PDO::PARAM_STR);
        }

        $result->execute();
        return $result->rowCount() != 0;
    }

    public static function edit_category($title, $image, $status, $old_title)
    {
        $sql = 'UPDATE `channel_categories` SET `title` = :title, `status` = :status';

        if ($image !== null) {
            $sql .= ', `image` = :image';
        }

        $sql .= ' WHERE `title` = :old_title';
        $result = $GLOBALS['DBH']->prepare($sql);

        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_STR);
        $result->bindParam(':old_title', $old_title, PDO::PARAM_STR);

        if ($image !== null) {
            $result->bindParam(':image', $image, PDO::PARAM_STR);
        }

        $result->execute();
        return $result->rowCount() != 0;
    }

    public static function check_category($title, $is_new_title)
    {
        if ($is_new_title) {
            if (static::get_category_by_title($title)['id']) {
                return "Категория канала с таким названием уже существует!";
            }
        }

        if (mb_strlen($title) == 0 || mb_strlen($title) > 25) {
            return 'Длина названия каталога канала может быть от 0 до 25 символов!';
        }

        return 'ok';
    }
}