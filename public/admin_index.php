<?php
session_start();

require_once '../app/controllers/AdminController.php';
$controller = new AdminController();
$controller->index();