<?php
session_start();

require_once '../app/controllers/ShowCommandesController.php';
$controller = new ShowCommandesController();
$controller->index();