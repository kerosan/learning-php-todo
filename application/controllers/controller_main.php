<?php

class Controller_Main extends Controller
{
    function action_index($props = null)
    {
        if(is_null($props)) {
            $props['page'] = 1;
        }
        $offset = App::config()['pagination']['itemsPerPage'];
        $start = $offset * $props['page'] - $offset;
        $order = $props['order'];
        $sort = $props['sort'];

        $data = (object)array();
        $this->model = new Model_Main();
        $table = $this->model->getTable();
        $data->list = $table->getItemList($start, $offset, $order, $sort);
        $data->count = $table->getCount();
        $data->admin = false;
        $data->page = $props['page'] ? intval($props['page']) : 1;
        $this->view->generate('main_view.php', 'template_view.php', $data);
    }
}