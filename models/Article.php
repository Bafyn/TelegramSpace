<?php

/**
 * Created by PhpStorm.
 * User: Nikitin Dima
 * Date: 22.04.2017
 * Time: 17:49
 */
class Article extends Model
{
    public function get_data()
    {
        $data = array();


    }

    /**
     * Returns all channel categories
     *
     * @return array - information about categories
     */
    public static function get_articles()
    {
        $sql = 'SELECT * FROM `articles`';
        $result = $GLOBALS['DBH']->query($sql);
        $articles = array();
        $i = 0;

        while ($row = $result->fetch()) {
            $articles[$i] = $row;

            switch ($articles[$i]['status']) {
                case 1:
                    $articles[$i]['status_class'] = 'success';
                    $articles[$i]['status_description'] = 'Активна';
                    break;
                case 2:
                    $articles[$i]['status_class'] = 'danger';
                    $articles[$i]['status_description'] = 'Неактивна';
                    break;
            }

            $i++;
        }

        return $articles;
    }
}