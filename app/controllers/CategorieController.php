<?php
// Inclure les modèles nécessaires
require_once __DIR__ . '/../models/Categorie.php';

class CategorieController {
    // Liste des catégories côté client (ou public)
    public function index() {
        $categories = Categorie::getAll();
        require_once __DIR__ . '/../views/client/layout/header.php';
        require_once __DIR__ . '/../views/client/liste_categories.php';
        require_once __DIR__ . '/../views/client/layout/footer.php';
    }

    // ===================== ADMIN =====================

    // Liste des catégories côté admin
    public function adminIndex() {
        $categories = Categorie::getAll();
        require_once __DIR__ . '/../views/admin/layout/header.php';
        require_once __DIR__ . '/../views/admin/categories/liste.php';
        require_once __DIR__ . '/../views/admin/layout/footer.php';
    }

    // Afficher formulaire ajout catégorie
    public function ajouter() {
        require_once __DIR__ . '/../views/admin/layout/header.php';
        require_once __DIR__ . '/../views/admin/categories/ajouter.php';
        require_once __DIR__ . '/../views/admin/layout/footer.php';
    }

    // Enregistrer une nouvelle catégorie
    public function enregistrer() {
        $data = [
            'nom' => $_POST['nom'],
            'description' => $_POST['description'] ?? null
        ];
        Categorie::create($data);
        header('Location: index.php?controller=categorie&action=adminIndex');
        exit();
    }

    // Afficher formulaire modification catégorie
    public function modifier($id) {
        $categorie = Categorie::getById($id);
        require_once __DIR__ . '/../views/admin/layout/header.php';
        require_once __DIR__ . '/../views/admin/categories/modifier.php';
        require_once __DIR__ . '/../views/admin/layout/footer.php';
    }

    // Mettre à jour catégorie
    public function maj($id) {
        $data = [
            'nom' => $_POST['nom'],
            'description' => $_POST['description'] ?? null
        ];
        Categorie::update($id, $data);
        header('Location: index.php?controller=categorie&action=adminIndex');
        exit();
    }

    // Supprimer catégorie
    public function supprimer($id) {
        Categorie::delete($id);
        header('Location: index.php?controller=categorie&action=adminIndex');
        exit();
    }
}
?>
