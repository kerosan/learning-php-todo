<ul class="list-unstyled">
    <li>
        <div class="panel panel-default createTask">
            <div class="panel-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" required id="inputName" placeholder="Name ...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" required id="inputEmail" placeholder="Email ...">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Message</label>
                        <div class="col-sm-10">
                            <textarea class="form-control" id="inputText" required
                                      placeholder="Type your message ..."></textarea>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Picture</label>
                        <div class="col-sm-10">
                            <button id="selectFile" class="btn btn-success btn-block text-uppercase">Open</button>
                            <input type="file" class="form-control hidden" id="inputFile">
                        </div>
                    </div>
                    <div class="btn-toolbar pull-right">
                        <button id="previewForm" class="btn btn-success text-uppercase">Preview</button>
                        <button id="saveForm" class="btn btn-primary text-uppercase">Save</button>
                        <button id="clearForm" class="btn btn-default text-uppercase">Clear</button>
                    </div>
                </div>
            </div>
        </div>
    </li>
</ul>
<ul class="list-unstyled preview">
    <li>
        <div class="panel panel-collapse panel-default collapse">
            <div class="panel-body">
                <div class="form-horizontal">
                    <div class="form-group">
                        <label for="inputName" class="col-sm-2 control-label">Name</label>
                        <div class="col-sm-10">
                            <p class="form-control-static" id="previewName"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Email</label>
                        <div class="col-sm-10">
                            <p class="form-control-static" id="previewEmail"></p>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Message</label>
                        <div class="col-sm-10">
                            <p class="form-control-static" id="previewText"></p>
                        </div>
                    </div>
                    <div class="form-group" id="previewImage">
                        <label class="col-sm-2 control-label">Picture</label>
                        <div class="col-sm-10">
                            <img id="previewPicture" alt="pic">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
</ul>
<ul class="list-unstyled todoList">
    <?php
    if (count($data->list) === 0) {
        ?>
        <li>
            <div class="alert panel-default emptyItem">
                <div class="text-center">Add new task</div>
            </div>
        </li>
        <?php
    } else {
        foreach ($data->list as $todo) {
            ?>
            <li>
                <div class="panel panel-default <?= $todo['ready'] ? 'checked' : '' ?>">
                    <div class="panel-body">
                        <?php
                        if ($data->admin) {
                            ?>
                            <input type="checkbox"
                                   class="status form-control"
                                   data-id="<?= $todo['id'] ?>"
                                   onclick="updateTask(<?= $todo['id'] ?>, <?= intval(!$todo['ready']) ?>, '<?= $todo['text'] ?>')"
                                <?= $todo['ready'] ? 'checked' : '' ?>>
                            <?php
                        }
                        ?>
                        <div class="form-horizontal">
                            <div class="form-group">
                                <label for="inputName" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?= $todo['name'] ?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Email</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static"><?= $todo['email'] ?></p>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-2 control-label">Message</label>
                                <div class="col-sm-10">
                                    <p class="form-control-static messageBar"><?= $todo['text'] ?>
                                        <?php
                                        if ($data->admin) {
                                            ?>
                                            <a href="javascript://" class="glyphicon glyphicon-edit pull-right"
                                               onclick='openModal(<?= $todo['id'] ?>, <?= intval($todo['ready']) ?>, <?= json_encode($todo['text']) ?>)'></a>
                                        <?php } ?>
                                    </p>
                                </div>
                            </div>
                            <div class="form-group <?= $todo['file'] ? '' : 'hidden' ?>">
                                <label class="col-sm-2 control-label">Picture</label>
                                <div class="col-sm-10">
                                    <img src="<?= $todo['file'] ?>" alt="pic">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </li>
            <?php
        }
    }
    ?>
</ul>

<?php
if (isset($data) && $data->count > App::config()['pagination']['itemsPerPage']) {
    $offset = App::config()['pagination']['itemsPerPage'];
    $base = $data->admin ? '/admin/' : '/';
    ?>
    <nav aria-label="Page navigation">
        <ul class="pagination">
            <li>
                <a href="<?= $base . '?page=1' ?>" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
            </li>
            <?php
            for ($i = 0, $j = 1; $i < $data->count; $j++, $i += $offset) {
                ?>
                <li class="<?= ($data->page === $j) ? 'active' : '' ?>"><a
                            href="<?= $base . '?page=' . $j ?>"><?= $j ?></a></li>
            <?php } ?>
            <li>
                <a href="<?= $base . '?page=' . ceil($data->count / $offset) ?>" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
            </li>
        </ul>
    </nav>
    <?php
}
?>

<div id="editMessageModal" class="modal fade" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Modal title</h4>
            </div>
            <div class="modal-body">
                <textarea class="form-control"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button id="modalSave" type="button" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


