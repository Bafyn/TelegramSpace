<?php

/**
 * Created by PhpStorm.
 * User: Nikitin Dima
 * Date: 22.04.2017
 * Time: 17:49
 */
class ArticleController extends Controller
{
    public function __construct()
    {
        $this->model = new Article();
        $this->view = new View();
    }


    public function action_index()
    {
        $article = $this->model->get_particular_article();

        if (!$article['is_valid_article']) {
            Router::error404();
            return TRUE;
        }

        $this->view->generate('articlepost.php', $article);

        return TRUE;
    }

    function action_list()
    {
        $data = Main::get_page_parts();
        $data += $this->model->get_data();

        $this->view->generate('articles.php', $data);

        return TRUE;
    }
}