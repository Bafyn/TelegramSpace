<?php

/**
 * Created by PhpStorm.
 * User: Nikitin Dima
 * Date: 20.04.2017
 * Time: 19:33
 */
class AdminController extends Controller
{
    public function __construct()
    {
        $this->model = new Admin();
        $this->view = new View();
    }

    function action_index()
    {
        $data = $this->model->get_subjects_info();

        require_once(ROOT . '/views/admin/index.php');

        return TRUE;
    }

    function action_login()
    {
        $data = $this->model->get_subjects_info();

        if (Data::isSetPostParameter("login_admin_submit")) {
            if ($this->log_in($data['mail'], $data['password'], $data['hash'])) {
                require_once(ROOT . '/views/admin/index.php');
                return TRUE;
            } else {
                $data['error'] = true;
            }
        }

        require_once(ROOT . '/views/admin/login.php');

        return TRUE;
    }

    function action_signout()
    {
        SetCookie("hash", "", time() - 3600);
        SetCookie("id", "", time() - 3600);
        Router::header_location('/admin/login');
    }


    function action_editchannel()
    {
        $channel_edit = $this->model->get_data();
        $info = array();

        if (isset($channel_edit['is_valid_channel']) && $_SESSION['secret_edit_channel'] !== Data::getPostParameter('secret_edit_channel')) {
            $_SESSION['secret_edit_channel'] = Data::getPostParameter('secret_edit_channel');

            if (!$channel_edit['is_valid_channel']) {
                $info['error'] = $channel_edit['error'];
            } else {
                $new_image_name = null;

                if ($_FILES['channel_image']['tmp_name']) {
                    $extension = strtolower(pathinfo($_FILES['channel_image']['name'], PATHINFO_EXTENSION));

                    if ($extension === 'png' || $extension === 'jpg') {
                        $new_image_name = 'c-' . $channel_edit['channel_id'] . '.' . $extension;
                        $image_path = ROOT . '/template/img/channels/' . $new_image_name;

                        if (!move_uploaded_file($_FILES['channel_image']['tmp_name'], $image_path)) {
                            $info['warning'] = "Изображение не было загружено. Попробуйте позже или выберите новое";
                        }
                    } else {
                        $info['warning'] = "Загружаемые изображения могуть иметь формат только .png или .jpg";
                    }
                }

                if (Channel::edit_channel($channel_edit['link'], $channel_edit['title'], $channel_edit['description'], $channel_edit['category'],
                    $channel_edit['members'], $channel_edit['rating'], $channel_edit['extra_info'], $channel_edit['status'], $new_image_name, $_SESSION['old_link_channel'])
                ) {
                    $info['success'] = "Канал был успешно изменен!";

                } else {
//                    $info['error'] = "Произошла ошибка. Попробуйте позже";
                }
            }
        }

        $data = $this->model->get_subjects_info();

        require_once(ROOT . '/views/admin/index.php');
        return TRUE;
    }

    function action_editbot()
    {
        $bot_edit = $this->model->get_data();
        $info = array();

        if (isset($bot_edit['is_valid_bot']) && $_SESSION['secret_edit_bot'] !== Data::getPostParameter('secret_edit_bot')) {
            $_SESSION['secret_edit_bot'] = Data::getPostParameter('secret_edit_bot');

            if (!$bot_edit['is_valid_bot']) {
                $info['error'] = $bot_edit['error'];
            } else {
                $new_image_name = null;

                if ($_FILES['bot_image']['tmp_name']) {
                    $extension = strtolower(pathinfo($_FILES['bot_image']['name'], PATHINFO_EXTENSION));

                    if ($extension === 'png' || $extension === 'jpg') {
                        $new_image_name = 'b-' . $bot_edit['bot_id'] . '.' . $extension;
                        $image_path = ROOT . '/template/img/bots/' . $new_image_name;

                        if (!move_uploaded_file($_FILES['bot_image']['tmp_name'], $image_path)) {
                            $info['warning'] = "Изображение не было загружено. Попробуйте позже или выберите новое";
                        }
                    } else {
                        $info['warning'] = "Загружаемые изображения могуть иметь формат только .png или .jpg";
                    }
                }

                if (Bot::edit_bot($bot_edit['link'], $bot_edit['username'], $bot_edit['title'], $bot_edit['description'],
                    $bot_edit['rating'], $bot_edit['extra_info'], $bot_edit['status'], $new_image_name, $_SESSION['old_link_bot'])
                ) {
                    $info['success'] = "Бот был успешно изменен!";
                } else {
//                    $info['error'] = "Произошла ошибка. Попробуйте позже";
                }
            }
        }

        $data = $this->model->get_subjects_info();

        require_once(ROOT . '/views/admin/index.php');
        return TRUE;
    }

    function action_editarticle()
    {

    }

    function action_editsticker()
    {

    }

    function action_editcategory()
    {
        $category_edit = $this->model->get_data();
        $info = array();

        if (isset($category_edit['is_valid_category']) && $_SESSION['secret_edit_category'] !== Data::getPostParameter('secret_edit_category')) {
            $_SESSION['secret_edit_category'] = Data::getPostParameter('secret_edit_category');

            if (!$category_edit['is_valid_category']) {
                $info['error'] = $category_edit['error'];
            } else {
                $new_image_name = null;

                if ($_FILES['category_image']['tmp_name']) {
                    $extension = strtolower(pathinfo($_FILES['category_image']['name'], PATHINFO_EXTENSION));

                    if ($extension === 'png' || $extension === 'jpg') {
                        $new_image_name = 'cat-' . $category_edit['category_id'] . '.' . $extension;
                        $image_path = ROOT . '/template/img/categories/' . $new_image_name;

                        if (!move_uploaded_file($_FILES['category_image']['tmp_name'], $image_path)) {
                            $info['warning'] = "Изображение не было загружено. Попробуйте позже или выберите новое";
                        }
                    } else {
                        $info['warning'] = "Загружаемые изображения могуть иметь формат только .png или .jpg";
                    }
                }

                if (Channel::edit_category($category_edit['title'], $new_image_name, $category_edit['status'], $_SESSION['old_title_category'])
                ) {
                    $info['success'] = "Категория была успешно изменена!";
                } else {
//                    $info['error'] = "Произошла ошибка. Попробуйте позже";
                }
            }
        }

        $data = $this->model->get_subjects_info();

        require_once(ROOT . '/views/admin/index.php');
        return TRUE;
    }

    function action_addcategory()
    {
        $category_add = $this->model->get_data();
        $info = array();

        if (isset($category_add['is_valid_category']) && $_SESSION['secret_edit_category'] !== Data::getPostParameter('secret_edit_category')) {
            $_SESSION['secret_edit_category'] = Data::getPostParameter('secret_edit_category');

            if (!$category_add['is_valid_category']) {
                $info['error'] = $category_add['error'];
            } else {
                $new_image_name = null;

                if ($_FILES['category_image']['tmp_name']) {
                    $extension = strtolower(pathinfo($_FILES['category_image']['name'], PATHINFO_EXTENSION));

                    if ($extension === 'png' || $extension === 'jpg') {
                        $new_image_name = 'cat-' . $category_add['category_id'] . '.' . $extension;
                        $image_path = ROOT . '/template/img/categories/' . $new_image_name;

                        if (!move_uploaded_file($_FILES['category_image']['tmp_name'], $image_path)) {
                            $info['warning'] = "Изображение не было загружено. Попробуйте позже или выберите новое";
                        }
                    } else {
                        $info['warning'] = "Загружаемые изображения могуть иметь формат только .png или .jpg";
                    }
                }

                if (Channel::add_channel_category($category_add['title'], $new_image_name, $category_add['status'])
                ) {
                    $info['success'] = "Категория была успешно добавлена!";
                } else {
//                    $info['error'] = "Произошла ошибка. Попробуйте позже";
                }
            }
        }

        $data = $this->model->get_subjects_info();

        require_once(ROOT . '/views/admin/index.php');
        return TRUE;
    }

    /**
     * authorizes user as admin
     *
     * @param $email - admin's email
     * @param $password - admin's password
     * @param $hash - new hash for identification of admin
     *
     * @return bool - success of authorization
     */
    private function log_in($email, $password, $hash)
    {
        $admin = Admin::get_admin_by_email($email);

        if (isset($admin['id']) && password_verify($password, $admin['password'])) {
            SetCookie("hash", $hash, time() + 3600 * 24, '/');
            SetCookie("id", $admin['id'], time() + 3600 * 24, '/');

            $sql = 'UPDATE `admins` SET `hash` = :hash WHERE `email` = :email';
            $result = $GLOBALS['DBH']->prepare($sql);

            $result->bindParam(':hash', $hash, PDO::PARAM_STR);
            $result->bindParam(':email', $email, PDO::PARAM_STR);
            return $result->execute();
        } else {
            return false;
        }
    }
}