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
        $data = $this->model->get_data();
        $this->view->generate('main.php', $data);

        return TRUE;
    }

    public function action_history()
    {
        $data = $this->model->get_data();
        $this->view->generate('history.php', $data);

        return TRUE;
    }

    public function action_texh()
    {
        $data = $this->model->get_data();
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
        $data = $this->model->get_data();
        $this->view->generate('articles.php', $data);

        return TRUE;
    }
}
