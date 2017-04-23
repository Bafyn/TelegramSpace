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
        $this->model = new Bot();
        $this->view = new View();
    }

    function action_index()
    {

    }

}