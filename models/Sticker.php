<?php

/**
 * Created by PhpStorm.
 * User: Nikitin Dima
 * Date: 20.04.2017
 * Time: 19:00
 */
class Sticker
{
    public function get_data()
    {
        $data = self::get_stickers(true);

        return $data;
    }

    /**
     * Returns information about stickers
     *
     * @return array - information about stickers
     */
    public static function get_stickers($is_active_only)
    {
        $sql = 'SELECT * FROM `stickers`';

        if ($is_active_only) {
            $sql .= ' WHERE `status` = 1 ORDER BY `rating` DESC';
        }

        $result = $GLOBALS['DBH']->query($sql);
        $stickers = array();
        $i = 0;

        while ($row = $result->fetch()) {
            $stickers[$i] = $row;

            switch ($stickers[$i]['status']) {
                case 1:
                    $stickers[$i]['status_class'] = 'success';
                    $stickers[$i]['status_description'] = 'Активна';
                    break;
                case 2:
                    $stickers[$i]['status_class'] = 'danger';
                    $stickers[$i]['status_description'] = 'Неактивна';
                    break;
            }

            $i++;
        }

        return $stickers;
    }

    public static function get_sticker_by_title($title)
    {
        $sql = 'SELECT * FROM `stickers` WHERE `title` = :title';
        $result = $GLOBALS['DBH']->prepare($sql);

        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->execute();

        return $row = $result->fetch();
    }

    public static function check_sticker($title, $description, $is_new_title)
    {
        if ($is_new_title) {
            if (static::get_sticker_by_title($title)['id']) {
                return "Набор стикеров с таким названием уже существует!";
            }
        }

        if (mb_strlen($title) == 0 || mb_strlen($title) > 50) {
            return 'Длина названия набора стикеров может быть от 1 до 50 символов!';
        }


        if (mb_strlen($description) == 0 || mb_strlen($description) > 300) {
            return 'Длина описания набора стикеров может быть от 1 до 300 символов!';
        }

        return 'ok';
    }


    public static function edit_sticker($title, $description, $rating, $image, $status, $old_title)
    {
        $sql = 'UPDATE `stickers` SET `title` = :title, `description` = :description, `rating` = :rating, `status` = :status';

        if ($image !== null) {
            $sql .= ', `image` = :image';
        }

        $sql .= ' WHERE `title` = :old_title';
        $result = $GLOBALS['DBH']->prepare($sql);

        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':rating', $rating, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_STR);
        $result->bindParam(':old_title', $old_title, PDO::PARAM_STR);

        if ($image !== null) {
            $result->bindParam(':image', $image, PDO::PARAM_STR);
        }

        $result->execute();
        return $result->rowCount() != 0;
    }


    public static function add_sticker($title, $description, $rating, $image, $status)
    {
        $sql = "INSERT INTO `stickers` VALUES (NULL, :title, :description, :rating";

        if ($image !== null) {
            $sql .= ', :image';
        } else {
            $sql .= ', "' . IMAGE_DEFAULT . '"';
        }

        $sql .= ', :status)';
        $result = $GLOBALS['DBH']->prepare($sql);

        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':rating', $rating, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_STR);

        if ($image !== null) {
            $result->bindParam(':image', $image, PDO::PARAM_STR);
        }

        $result->execute();
        return $result->rowCount() != 0;
    }
}