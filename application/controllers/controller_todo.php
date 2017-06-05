<?php
require_once 'UploadHandler.php';

class Controller_Todo extends Controller
{

    function action_index($props = null)
    {
        $this->model = new Model_Todo();
        $this->view->generate('main_view.php', 'template_view.php');
    }

    function action_create()
    {
        $this->model = new Model_Todo();

        $success = false;
        /** @var Todo $table */
        $table = $this->model->getTable();
        $data = array(
            'name' => $_POST['name'],
            'email' => $_POST['email'],
            'text' => $_POST['text'],
            'file' => $_POST['file'][0]['url'],
            'ready' => false,
            'deleted' => false,
        );
        $success = $table->createTask($data);

        echo json_encode(array('success' => $success));
    }

    function action_update()
    {
        $this->model = new Model_Todo();

        $success = false;
        /** @var Todo $table */
        $table = $this->model->getTable();
        $data = array(
            'id' => $_POST['id'],
            'text' => $_POST['text'],
            'ready' => $_POST['ready']
        );
        $success = $table->updateTask($data);

        echo json_encode(array('success' => $success));
    }

    function action_upload()
    {
        $options = array(
            'upload_dir' => 'files/',
            'accept_file_types' => '/\.(gif|jpe?g|png)$/i'
        );

        $upload_handler = new UploadHandler($options);
    }
}