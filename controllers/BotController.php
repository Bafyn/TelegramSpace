<?php

/**
 * Created by PhpStorm.
 * User: Nikitin Dima
 * Date: 20.04.2017
 * Time: 18:56
 */
class BotController extends Controller
{
    public function __construct()
    {
        $this->model = new Bot();
        $this->view = new View();
    }

    function action_index()
    {
        $data = $this->model->get_data();
        $this->view->generate('botsinfo.php', $data);

        return TRUE;
    }

    public function action_info()
    {
        $data = array();
        $data['about_bots'] = Main::get_page_parts(6);

        $this->view->generate('botsinfo.php', $data);

        return TRUE;
    }

    public function action_list()
    {
        $data = $this->model->get_data();
        $data['bots_catalog'] = Main::get_page_parts(7);

        if (isset($data['is_offer']) && $data['is_offer'] && $_SESSION['secret_offer_bot'] !== Data::getPostParameter('secret_offer_bot')) {
            $_SESSION['secret_offer_bot'] = Data::getPostParameter('secret_offer_bot');

            if ($this->add_bot($data['link'], $data['username'], $data['title'], $data['description'], $data['extra_info'])) {
                $data['success'] = "Запрос на добавление бота был успешно отправлен!";
            } else {
                $data['error'] = "Запрос на добавление бота не был отправлен. Попробуйте позже.";
            }
        }

        require_once(ROOT . '/views/bots.php');

        return TRUE;
    }

    /**
     * Adds bot to DB
     *
     * @param $link - link of the bot
     * @param $username - username of the bot
     * @param $title - title of the bot
     * @param $description - description of the bot
     * @param $extra_info - extra information about the bot
     *
     * @return mixed - result of query
     */
    private function add_bot($link, $username, $title, $description, $extra_info)
    {
        $sql = "INSERT INTO `bots` (link, username, title, description, extra_info) VALUES (:link, :username, :title, :description, :extra_info)";

        $result = $GLOBALS['DBH']->prepare($sql);
        $result->bindParam(':link', $link, PDO::PARAM_STR);
        $result->bindParam(':username', $username, PDO::PARAM_STR);
        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':extra_info', $extra_info, PDO::PARAM_STR);

        $result->execute();
        return $result->rowCount() != 0;
    }

}