<?php
session_start();
require '/app/config/config.php';
require '/app/functions/functions.php';
$url =  'app/views/home.php';
header('Location: '.$url);    