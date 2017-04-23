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

    }

    /**
     * Returns information about stickers
     *
     * @return array - information about stickers
     */
    public static function get_stickers()
    {
        $sql = 'SELECT * FROM `stickers`';
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
}