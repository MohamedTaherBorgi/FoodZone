<?php
session_start();

require_once '../app/controllers/LivreurController.php';
$controller = new LivreurController();
$controller->index();