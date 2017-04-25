<?php

class Main extends Model
{
    public function get_data()
    {

    }

    /**
     * Returns code and max size of parts of particular page
     *
     * @param $page_id - id of the page:
     *          1 - main
     *          2 - history
     *          3 - about_channels
     *          4 - channels_catalog
     *          5 - technologies
     *          6 - about_bots
     *          7 - bots_catalog
     *          8 - stickers_catalog
     *          9 - create_stickers
     *          10 - articles
     *
     * @return array - code and max size of parts of particular page
     */
    public static function get_page_parts()
    {
        $sql = 'SELECT * FROM `page_elements`';
        $result = $GLOBALS['DBH']->prepare($sql);

        $result->execute();

        $elements = array();
        $i = 0;

        while ($row = $result->fetch()) {
            $elements[$row['id']]['code'] = $row['code'];
            $elements[$row['id']]['max_size'] = $row['max_size'];
            $i++;
        }

        return $elements;
    }

    public static function get_page_element_by_id($part_id)
    {
        $sql = 'SELECT * FROM `page_elements` WHERE `id` = :id';
        $result = $GLOBALS['DBH']->prepare($sql);

        $result->bindParam(':id', $part_id, PDO::PARAM_STR);
        $result->execute();

        return $row = $result->fetch();
    }
}

