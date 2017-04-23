<?php

/**
 * Created by PhpStorm.
 * User: Nikitin Dima
 * Date: 20.04.2017
 * Time: 18:54
 */
class ChannelController extends Controller
{
    public function __construct()
    {
        $this->model = new Channel();
        $this->view = new View();
    }

    public function action_index()
    {
        $data = $this->model->get_data();

        if (!$data['is_valid_category']) {
            Router::error404();
            return TRUE;
        }

        $this->view->generate('channelcategory.php', $data);

        return TRUE;
    }

    function action_categories()
    {
        $data = $this->model->get_data();

        if (isset($data['is_offer']) && $data['is_offer'] && $_SESSION['secret_offer_channel'] !== Data::getPostParameter('secret_offer_channel')) {
            $_SESSION['secret_offer_channel'] = Data::getPostParameter('secret_offer_channel');

            if ($this->add_channel($data['link'], $data['category'], $data['title'], $data['description'], $data['extra_info'])) {
                $data['success'] = "Запрос на добавление канала был успешно отправлен!";
            } else {
                $data['error'] = "Запрос на добавление канала не был отправлен. Попробуйте позже.";
            }
        }

        require_once(ROOT . '/views/catalog.php');

        return TRUE;
    }

    public function action_info()
    {
        $data = $this->model->get_data();
        $this->view->generate('channelinfo.php', $data);

        return TRUE;
    }

    /**
     * Adds channel to DB
     *
     * @param $link - link of the channel
     * @param $category - category of the channel
     * @param $description - description of the channel
     * @param $extra_info - extra information about the channel
     *
     * @return mixed - result of query
     */
    private function add_channel($link, $category, $title, $description, $extra_info)
    {
        $sql = "INSERT INTO `channels` (link, title, description, category_id, extra_info) VALUES (:link, :title, :description, :category, :extra_info)";

        $result = $GLOBALS['DBH']->prepare($sql);
        $result->bindParam(':link', $link, PDO::PARAM_STR);
        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':category', $category, PDO::PARAM_INT);
        $result->bindParam(':extra_info', $extra_info, PDO::PARAM_STR);

        $result->execute();
        return $result->rowCount() != 0;
    }
}