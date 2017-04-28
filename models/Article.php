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
        $data['articles'] = static::get_articles(true);

        return $data;
    }

    public function get_particular_article()
    {
        $article = array();

        if (Data::isSetGetParameter('post')) {
            $article = static::get_article_by_id(Data::getGetParameter('post'));
            if ($article['id']) {
                $article['is_valid_article'] = true;
            } else {
                $article['is_valid_article'] = false;
            }
        } else {
            $article['is_valid_article'] = false;
        }

        return $article;
    }

    /**
     * Returns all channel categories
     *
     * @return array - information about categories
     */
    public static function get_articles($is_active_only)
    {
        $sql = 'SELECT * FROM `articles`';

        if ($is_active_only) {
            $sql .= ' WHERE `status` = 1 ORDER BY `pub_date` DESC';
        }

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

    public static function check_article($title, $is_new_title)
    {
        if ($is_new_title) {
            if (static::get_article_by_title($title)['id']) {
                return "Статься с таким названием уже существует!";
            }
        }

        if (mb_strlen($title) == 0 || mb_strlen($title) > 150) {
            return 'Длина названия статьи может быть от 1 до 150 символов!';
        }

        return 'ok';
    }

    public static function get_article_by_title($title)
    {
        $sql = 'SELECT * FROM `articles` WHERE `title` = :title';
        $result = $GLOBALS['DBH']->prepare($sql);

        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->execute();

        return $row = $result->fetch();
    }

    public static function get_article_by_id($id)
    {
        $sql = 'SELECT * FROM `articles` WHERE `id` = :id';
        $result = $GLOBALS['DBH']->prepare($sql);

        $result->bindParam(':id', $id, PDO::PARAM_STR);
        $result->execute();

        return $row = $result->fetch();
    }

    public static function add_article($title, $content, $image, $status)
    {
        $sql = "INSERT INTO `articles` VALUES (NULL, :title, :content, NOW()";

        if ($image !== null) {
            $sql .= ', :image';
        } else {
            $sql .= ', "' . IMAGE_DEFAULT . '"';
        }

        $sql .= ', :status)';
        $result = $GLOBALS['DBH']->prepare($sql);

        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':content', $content, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_STR);

        if ($image !== null) {
            $result->bindParam(':image', $image, PDO::PARAM_STR);
        }

        $result->execute();
        return $result->rowCount() != 0;
    }

    public static function edit_article($title, $content, $image, $status, $old_title)
    {
        $sql = 'UPDATE `articles` SET `title` = :title, `content` = :content, `status` = :status';

        if ($image !== null) {
            $sql .= ', `image` = :image';
        }

        $sql .= ' WHERE `title` = :old_title';
        $result = $GLOBALS['DBH']->prepare($sql);

        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':content', $content, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_STR);
        $result->bindParam(':old_title', $old_title, PDO::PARAM_STR);

        if ($image !== null) {
            $result->bindParam(':image', $image, PDO::PARAM_STR);
        }

        $result->execute();
        return $result->rowCount() != 0;
    }
}
