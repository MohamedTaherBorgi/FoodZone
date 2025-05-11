<?php
class EditUserController
{
    public function index()
    {
        // Load the layout (header, footer) and view
        require '../app/views/admin/layout/header.php';
        require '../app/views/admin/edit_user.php';  // This is where the actual home page content is rendered
        require '../app/views/admin/layout/footer.php';
    }
}