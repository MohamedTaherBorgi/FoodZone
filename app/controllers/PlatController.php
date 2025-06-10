<?php
// Inclure les modèles AVANT d'utiliser leurs classes
require_once __DIR__ . '/../models/Plat.php';
require_once __DIR__ . '/../models/Categorie.php';

class PlatController {
    // Liste des plats pour le client
    public function index() {
        $plats = Plat::getAll();
        require_once __DIR__ . '/../views/client/layout/header.php';
        require_once __DIR__ . '/../views/client/liste_plats.php';
        require_once __DIR__ . '/../views/client/layout/footer.php';
    }

    // Afficher les plats par catégorie
    public function afficherParCategorie($categorie_id) {
        $plats = Plat::getByCategorie($categorie_id);
        require_once __DIR__ . '/../views/client/layout/header.php';
        require_once __DIR__ . '/../views/client/plats_par_categorie.php';
        require_once __DIR__ . '/../views/client/layout/footer.php';
    }

    // ===================== ADMIN =====================

    public function adminIndex() {
        $plats = Plat::getAll();
        require_once __DIR__ . '/../views/admin/layout/header.php';
        require_once __DIR__ . '/../views/admin/plats/liste.php';
        require_once __DIR__ . '/../views/admin/layout/footer.php';
    }

    public function ajouter() {
        $categories = Categorie::getAll();
        require_once __DIR__ . '/../views/admin/layout/header.php';
        require_once __DIR__ . '/../views/admin/plats/ajouter.php';
        require_once __DIR__ . '/../views/admin/layout/footer.php';
    }

    public function enregistrer() {
        $imagePath = null;

        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $targetDir = "public/uploads/";
            $imageName = time() . '_' . basename($_FILES["image"]["name"]);
            $imagePath = $targetDir . $imageName;
            move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
        }

        $data = [
            'nom' => $_POST['nom'],
            'description' => $_POST['description'],
            'prix' => $_POST['prix'],
            'categorie_id' => $_POST['categorie_id'],
            'image' => $imagePath
        ];

        Plat::create($data);
        header('Location: index.php?controller=plat&action=adminIndex');
    }

    public function modifier($id) {
        $plat = Plat::getById($id);
        $categories = Categorie::getAll();
        require_once __DIR__ . '/../views/admin/layout/header.php';
        require_once __DIR__ . '/../views/admin/plats/modifier.php';
        require_once __DIR__ . '/../views/admin/layout/footer.php';
    }

    public function maj($id) {
        $plat = Plat::getById($id);
        $imagePath = $plat['image'];

        if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
            $targetDir = "public/uploads/";
            $imageName = time() . '_' . basename($_FILES["image"]["name"]);
            $imagePath = $targetDir . $imageName;
            move_uploaded_file($_FILES["image"]["tmp_name"], $imagePath);
        }

        $data = [
            'nom' => $_POST['nom'],
            'description' => $_POST['description'],
            'prix' => $_POST['prix'],
            'categorie_id' => $_POST['categorie_id'],
            'image' => $imagePath
        ];

        Plat::update($id, $data);
        header('Location: index.php?controller=plat&action=adminIndex');
    }

    public function supprimer($id) {
        Plat::delete($id);
        header('Location: index.php?controller=plat&action=adminIndex');
    }
}
