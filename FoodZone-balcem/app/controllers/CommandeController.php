<?php
require_once 'models/Commande.php';

class CommandeController {
    private $commandeModel;

    public function __construct() {
        $this->commandeModel = new Commande();
    }

    // Affiche la liste des commandes pour un utilisateur (client ou admin)
    public function listeCommandes() {
        session_start();
        $role = $_SESSION['role'] ?? null;
        $userId = $_SESSION['user_id'] ?? null;

        if (!$userId) {
            header("Location: /login");
            exit;
        }

        if ($role === 'admin') {
            $commandes = $this->commandeModel->getAllCommandes();
        } else {
            $commandes = $this->commandeModel->getCommandesByUser($userId);
        }

        require 'views/' . ($role === 'admin' ? 'admin' : 'client') . '/commandes.php';
    }

    // Valider une commande (ex: après paiement)
    public function validerCommande() {
        session_start();
        if (!isset($_SESSION['user_id'])) {
            header("Location: /login");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $userId = $_SESSION['user_id'];
            $adresse = $_POST['adresse_client'] ?? '';
            $platsChoisis = $_POST['plats_choisis'] ?? []; // tableau d’id de plats

            // Calcul prix total (à faire via modèle)
            $prixTotal = $this->commandeModel->calculerPrixTotal($platsChoisis);

            // Enregistrement de la commande
            $this->commandeModel->creerCommande($userId, $platsChoisis, $prixTotal, $adresse);

            header("Location: /commandes");
            exit;
        }
    }
}
