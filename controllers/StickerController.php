<?php

/**
 * Created by PhpStorm.
 * User: Nikitin Dima
 * Date: 20.04.2017
 * Time: 18:58
 */
class StickerController extends Controller
{
    public function __construct()
    {
        $this->model = new Sticker();
        $this->view = new View();
    }

    function action_index()
    {

    }

    public function action_list()
    {
        $data['stickers'] = $this->model->get_data();
        $data += Main::get_page_parts();

        $this->view->generate('stickercategories.php', $data);

        return TRUE;
    }

    public function action_manual()
    {
        $data = Main::get_page_parts();

        $this->view->generate('manual.php', $data);

        return TRUE;
    }

}