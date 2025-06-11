<?php
session_start();

require_once '../app/controllers/EditLivraisonController.php';
$controller = new EditLivraisonController();
$controller->index();