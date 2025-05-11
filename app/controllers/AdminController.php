<?php
class AdminController
{
    public function index()
    {
        // Load the layout (header, footer) and view
        require '../app/views/admin/layout/header.php';  // This is where the actual home page content is rendered
        require '../app/views/admin/index.php';  // This is where the actual home page content is rendered
        require '../app/views/admin/layout/footer.php';  // This is where the actual home page content is rendered
    }
}