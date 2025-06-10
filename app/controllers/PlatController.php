<?php
// app/controllers/HomeController.php
class PlatController {
    public function index() {
        // Load the layout (header, footer) and view
        require '../app/views/client/layout/header.php';
        require '../app/views/client/liste_plats.php';  
        require '../app/views/client/layout/footer.php';
    }
}