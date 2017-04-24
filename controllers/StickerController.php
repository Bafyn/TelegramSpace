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
        $data = $this->model->get_data();
        $this->view->generate('stickercategories.php', $data);

        return TRUE;
    }

    public function action_list()
    {
        $data = array();
        $data['stickers_catalog'] = Main::get_page_parts(8);

        $this->view->generate('stickercategories.php', $data);

        return TRUE;
    }

    public function action_manual()
    {
        $data = array();
        $data['create_stickers'] = Main::get_page_parts(9);

        $this->view->generate('manual.php', $data);

        return TRUE;
    }

}