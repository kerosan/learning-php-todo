<div class="panel panel-default" style="padding:20px;">
    <h1>Sign In</h1>
    <form class="form" action="" method="post">
        <div class="form-horizontal">
            <div class="form-group">
                <label for="inputName" class="col-sm-2 control-label">login: </label>
                <div class="col-sm-10">
                    <input type="text" name="login" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label class="col-sm-2 control-label">password: </label>
                <div class="col-sm-10">
                    <input type="password" name="password" class="form-control">
                </div>
            </div>
            <input type="submit" value="Sign In" name="btn" class="submitSignIn btn btn-primary ">
        </div>
    </form>
</div>

<?php extract($data); ?>
<?php if ($login_status == "access_granted") { ?>
    <div class="alert alert-success alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong>Success!</strong>
    </div>
<?php } elseif ($login_status == "access_denied") { ?>
    <div class="alert alert-danger alert-dismissible fade in" role="alert">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
        </button>
        <strong>Incorrect login or password</strong>
    </div>
<?php } ?>