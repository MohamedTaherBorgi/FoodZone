<?php
session_start();

require_once '../app/controllers/PlatController.php';
$controller = new PlatController();
$controller->index();