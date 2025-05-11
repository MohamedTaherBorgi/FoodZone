<?php
session_start();

require_once '../app/controllers/EditUserController.php';
$controller = new EditUserController();
$controller->index();