<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>TODO</title>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <!-- Bootstrap -->
    <link rel='stylesheet' type='text/css' href='//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css'>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
    <script src="/assets/js/main.js"></script>
    <link rel="stylesheet" type="text/css" href="/assets/css/style.css"/>

    <!-- The jQuery UI widget factory, can be omitted if jQuery UI is already included -->
    <script src="/assets/js/vendor/jQuery-File-Upload-9.18.0/js/vendor/jquery.ui.widget.js"></script>
    <!-- The Load Image plugin is included for the preview images and image resizing functionality -->
    <script src="https://blueimp.github.io/JavaScript-Load-Image/js/load-image.all.min.js"></script>
    <!-- The Canvas to Blob plugin is included for image resizing functionality -->
    <script src="https://blueimp.github.io/JavaScript-Canvas-to-Blob/js/canvas-to-blob.min.js"></script>
    <!-- The Iframe Transport is required for browsers without support for XHR file uploads -->
    <script src="/assets/js/vendor/jQuery-File-Upload-9.18.0/js/jquery.iframe-transport.js"></script>
    <!-- The basic File Upload plugin -->
    <script src="/assets/js/vendor/jQuery-File-Upload-9.18.0/js/jquery.fileupload.js"></script>
    <!-- The File Upload processing plugin -->
    <script src="/assets/js/vendor/jQuery-File-Upload-9.18.0/js/jquery.fileupload-process.js"></script>
    <!-- The File Upload image preview & resize plugin -->
    <script src="/assets/js/vendor/jQuery-File-Upload-9.18.0/js/jquery.fileupload-image.js"></script>
</head>
<body>
<nav class="navbar navbar-inverse">
    <p class="navbar-text"><a href="/" class="navbar-link">Todo</a> (<a
                href="/<?= $data->admin ? 'admin/logout' : 'admin' ?>"
                class="navbar-link text-lowercase"><?= $data->admin ? 'Logout' : 'Login' ?></a>)
    </p>
    <span role="presentation" class="dropdown navbar-text">
        <a class="dropdown-toggle" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
           aria-expanded="false">
            Sort <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
            <?php
            $pageNumber = $data->page;
            $baseUrl = $data->admin ? '/admin/' : '/';
            ?>
            <li><a href="<?=$baseUrl. '?page=' . $pageNumber. '&order=name&sort=asc' ?>">Name &uarr;</a></li>
            <li><a href="<?=$baseUrl. '?page=' . $pageNumber. '&order=name&sort=desc' ?>">Name &darr;</a></li>
            <li><a href="<?=$baseUrl. '?page=' . $pageNumber. '&order=email&sort=asc' ?>">Email &uarr;</a></li>
            <li><a href="<?=$baseUrl. '?page=' . $pageNumber. '&order=email&sort=desc' ?>">Email &darr;</a></li>
            <li><a href="<?=$baseUrl. '?page=' . $pageNumber. '&order=ready&sort=asc' ?>">Status &uarr;</a></li>
            <li><a href="<?=$baseUrl. '?page=' . $pageNumber. '&order=ready&sort=desc' ?>">Status &darr;</a></li>
        </ul>
    </span>
    <p class="navbar-text"><a href="/dayside/">dayside</a></p>
    <p class="navbar-text navbar-right name">Nick Artemov</p>
</nav>
<div class="container">
    <?php include 'application/views/' . $content_view; ?>
</div>
</body>
</html>