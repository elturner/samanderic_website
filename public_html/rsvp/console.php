<?php

require_once "auth.php";

$db = new Database();
$auth = new Auth($db);

if (isset($_POST["logout"])) {
	$auth->logout();
} else if (isset($_POST["submit"]) && isset($_POST["username"]) && isset($_POST["password"])) {
	$auth->login($_POST["username"], $_POST["password"]);
} else {
	$auth->restore_session();
}

$table_include = "form_results.php";
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title><?= $auth->is_logged_in() ? "Admin Console" : "Welcome | Login" ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <style media="screen">
        html, body {
            font-family: -apple-system, avenir, 'avenir next', roboto, 'helvetica neue', helvetica, ubuntu, arial, sans-serif !important;
        }
    </style>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/s/bs-3.3.5/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.10,b-1.1.0,b-colvis-1.1.0,b-html5-1.1.0,b-print-1.1.0,cr-1.3.0,fh-3.1.0,r-2.0.0,sc-1.4.0/datatables.min.css"/>

    <script type="text/javascript" src="https://cdn.datatables.net/s/bs-3.3.5/jq-2.1.4,jszip-2.5.0,pdfmake-0.1.18,dt-1.10.10,b-1.1.0,b-colvis-1.1.0,b-html5-1.1.0,b-print-1.1.0,cr-1.3.0,fh-3.1.0,r-2.0.0,sc-1.4.0/datatables.min.js"></script>
</head>
<body style="background-color: #d7d7d7;">
    <? if ($auth->is_logged_in()) { ?>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<p class="navbar-brand">
						(ﾉ◕ヮ◕)ﾉ*:･ﾟ✧
					</p>
				</div>
                <form name="logout" method="post" class="navbar-form navbar-right">
                    <input class="btn btn-default" type="submit" name="logout" value="Logout">
                </form>
		</div>
		</nav>
		<div class="panel panel-default" style="max-width:98%;padding:0.7em;margin-left:auto;margin-right:auto;display:block;">
	<div class="table-responsive">

    <?php include $table_include; ?>

</div>
<br>
<script>
$(document).ready( function () {
    $('#table_id').DataTable( {
        dom: 'Bfrtip',
        buttons: [
        {
            extend: 'csv',
            text: 'Download',
            exportOptions: {
                modifier: {
                    search: 'none'
                }
            }
        }
    ],
        stateSave: true,
        processing: true,
        paging: false,
        colReorder: true,
        responsive: true,
        fixedHeader: true
    } );
} );
</script>
<? }else{ ?>
    <!-- Login form -->
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container-fluid">
            <div class="navbar-header">
                <a class="navbar-brand" href="#">
                    (ﾉ◕ヮ◕)ﾉ*:･ﾟ✧
                </a>
                <form method="post" class="navbar-form navbar-left" role="login">
                    <div class="form-group">
                        <input type="text" class="form-control" name="username" placeholder="Username">
                        <input type="password" class="form-control" name="password" placeholder="Password">
                    </div>
                    <input class="btn btn-default" type="submit" name="submit" value="Login">
                </form>
            </div>
        </div>
    </nav>
<? } ?>
</body>
</html>
