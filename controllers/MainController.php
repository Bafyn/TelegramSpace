<?php

class MainController extends Controller
{

    function __construct()
    {
        $this->model = new Main();
        $this->view = new View();
    }

    public function action_index()
    {
        $data = Main::get_page_parts();
        $this->view->generate('main.php', $data);

        return TRUE;
    }

    public function action_history()
    {
        $data = Main::get_page_parts();
        $this->view->generate('history.php', $data);

        return TRUE;
    }

    public function action_texh()
    {
        $data = Main::get_page_parts();
        $this->view->generate('texh.php', $data);

        return TRUE;
    }

    public function action_download()
    {
        $data = $this->model->get_data();
        $this->view->generate('download.php', $data);

        return TRUE;
    }

    public function action_articles()
    {
        $data = Main::get_page_parts();
        $this->view->generate('articles.php', $data);

        return TRUE;
    }
}
