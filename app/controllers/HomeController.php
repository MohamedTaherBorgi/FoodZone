<?php
// app/controllers/HomeController.php
class HomeController {
    public function index() {
        // Load the layout (header, footer) and view
        require '../app/views/client/layout/header.php';
        require '../app/views/client/home.php';  // This is where the actual home page content is rendered
        require '../app/views/client/layout/footer.php';
    }
}