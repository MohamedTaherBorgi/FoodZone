<?php
session_start();

require_once '../app/controllers/Login_registerController.php';
$controller = new Login_registerController();
$controller->login();