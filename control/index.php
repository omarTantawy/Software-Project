<?php

include '../prepare.php';

$module = $_GET['p'];
$router = new Router($module);
$router->render();