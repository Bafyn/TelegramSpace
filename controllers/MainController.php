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
        $data['main'] = Main::get_page_parts(1);
        $this->view->generate('main.php', $data);

        return TRUE;
    }

    public function action_history()
    {
        $data['history'] = Main::get_page_parts(2);
        $this->view->generate('history.php', $data);

        return TRUE;
    }

    public function action_texh()
    {
        $data['technologies'] = Main::get_page_parts(5);
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
        $data['articles'] = Main::get_page_parts(10);
        $this->view->generate('articles.php', $data);

        return TRUE;
    }
}
