<?php
require_once 'application/models/model_main.php';

class Controller_Admin extends Controller
{
    function action_index($props = null)
    {
        session_start();
        if (is_null($props)) {
            $props['page'] = 1;
        }
        $offset = App::config()['pagination']['itemsPerPage'];
        $start = $offset * $props['page'] - $offset;
        $order = $props['order'];
        $sort = $props['sort'];
        if ($_SESSION['admin'] == "123") {
            $data = (object)array();
            $this->model = new Model_Main();
            $table = $this->model->getTable();
            $data->list = $table->getItemList($start, $offset, $order, $sort);
            $data->count = $table->getCount();
            $data->admin = true;
            $data->page = $props['page'] ? intval($props['page']) : 1;

            $this->view->generate('main_view.php', 'template_view.php', $data);
        } else {
            session_destroy();
            App::Login();
        }
    }

    function action_logout()
    {
        session_start();
        session_destroy();
        header('Location:/');
    }
}