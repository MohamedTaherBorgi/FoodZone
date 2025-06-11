<?php
class EditLivraisonController
{
    public function index()
    {
        // Load the layout (header, footer) and view
        require '../app/views/admin/layout/header.php';
        require '../app/views/livreur/edit_livraison.php';
        require '../app/views/admin/layout/footer.php';
    }
}