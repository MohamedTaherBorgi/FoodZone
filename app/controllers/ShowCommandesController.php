<?php
class ShowCommandesController
{
    public function index()
    {
        // Load the layout (header, footer) and view
        require '../app/views/client/layout/header.php';
        require '../app/views/client/ShowCommandes.php';
        require '../app/views/client/layout/footer.php';
    }
}