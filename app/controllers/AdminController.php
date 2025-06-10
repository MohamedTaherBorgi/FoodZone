<?php
session_start();

require_once __DIR__ . '/../models/Utilisateur.php';

class AdminController {

    // Affiche la page de connexion admin
    public function login() {
        require_once __DIR__ . '/../views/admin/auth/login.php';
    }

    // Traite la connexion admin
    public function authenticate() {
        $email = $_POST['email'] ?? '';
        $password = $_POST['password'] ?? '';

        $user = Utilisateur::getByEmail($email);

        if ($user && password_verify($password, $user['password']) && $user['role'] === 'admin') {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_role'] = $user['role'];
            header('Location: index.php?controller=admin&action=dashboard');
            exit();
        } else {
            $error = "Identifiants invalides.";
            require_once __DIR__ . '/../views/admin/auth/login.php';
        }
    }

    // Page d'accueil admin (dashboard)
    public function dashboard() {
        $this->checkAuth();
        require_once __DIR__ . '/../views/admin/layout/header.php';
        require_once __DIR__ . '/../views/admin/dashboard.php';
        require_once __DIR__ . '/../views/admin/layout/footer.php';
    }

    // Déconnexion
    public function logout() {
        session_destroy();
        header('Location: index.php?controller=admin&action=login');
        exit();
    }

    // Méthode pour vérifier si l'utilisateur est admin connecté
    private function checkAuth() {
        if (!isset($_SESSION['user_id']) || $_SESSION['user_role'] !== 'admin') {
            header('Location: index.php?controller=admin&action=login');
            exit();
        }
    }
}
