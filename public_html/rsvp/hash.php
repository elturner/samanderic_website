<?php

require_once "auth.php";

$db = new Database();
$auth = new Auth($db);

echo $auth->create_password_hash($_GET["password"]);

