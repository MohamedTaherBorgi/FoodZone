<?php
class LivreurController
{
    public function index()
    {
        // Load the layout (header, footer) and view
        require '../app/views/admin/layout/header.php';  // This is where the actual home page content is rendered
        require '../app/views/livreur/index.php';  // This is where the actual home page content is rendered
        require '../app/views/admin/layout/footer.php';  // This is where the actual home page content is rendered
    }
}