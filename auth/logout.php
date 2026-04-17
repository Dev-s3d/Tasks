<?php
include_once '../classes/clsPath.php';

session_start();
session_unset();
session_destroy();

$path = clsPath::root();
header("Location: {$path}");
exit;
