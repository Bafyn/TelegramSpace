<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Checks and returns values of POST, GET and COOKIE parameters
 *
 * @author Nikitin Dima
 */
class Data
{

    /**
     * Checks whether set GET parameter
     *
     * @param string $param
     * @return bool
     */
    public static function isSetGetParameter($param)
    {
        return filter_input(INPUT_GET, $param) != NULL;
    }

    /**
     * Checks whether set POST parameter
     *
     * @param string $param
     * @return bool
     */
    public static function isSetPostParameter($param)
    {
        return filter_input(INPUT_POST, $param) != NULL;
    }

    /**
     * Checks whether set COOKIE parameter
     *
     * @param string $param
     * @return bool
     */
    public static function isSetCookieParameter($param)
    {
        return filter_input(INPUT_COOKIE, $param) != NULL;
    }

    /**
     * returns GET parameter by name
     *
     * @param string $param
     * @return string
     */
    public static function getGetParameter($param)
    {
        return htmlspecialchars(strip_tags(filter_input(INPUT_GET, $param)));
    }

    /**
     * returns POST parameter by name
     *
     * @param string $param
     * @return string
     */
    public static function getPostParameter($param)
    {
        return htmlspecialchars(strip_tags(filter_input(INPUT_POST, $param)));
    }

    /**
     * returns COOKIE parameter by name
     *
     * @param string $param
     * @return string
     */
    public static function getCookieParameter($param)
    {
        return htmlspecialchars(strip_tags(filter_input(INPUT_COOKIE, $param)));
    }

    /**
     * returns number of active subjects by its id
     *
     * @param $subject_id :
     *          0 - channels
     *          1 - bots
     *          2 - articles
     *          3 - stickers
     *          4 - channel categories
     *
     * @return mixed - number of subjects
     */
    public static function get_num_of_active_subjects($subject_id)
    {
        switch ($subject_id) {
            case 0:
                $table_name = 'channels';
                break;
            case 1:
                $table_name = "bots";
                break;
            case 2:
                $table_name = "articles";
                break;
            case 3:
                $table_name = "stickers";
                break;
            case 4:
                $table_name = "channel_categories";
                break;
        }

        $sql = "SELECT COUNT(*) FROM `$table_name` WHERE `status` = 1";
        $result = $GLOBALS['DBH']->prepare($sql);

        $result->execute();
        return $result->fetch(PDO::FETCH_NUM)[0];
    }
}
