<?php
class PanierController {

    // Affiche le contenu du panier
    public function afficherPanier() {
        session_start();
        $panier = $_SESSION['panier'] ?? [];
        require 'views/client/panier.php';
    }

    // Ajouter un plat au panier
    public function ajouterAuPanier() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $platId = $_POST['plat_id'];
            $quantite = $_POST['quantite'] ?? 1;

            // Initialiser le panier s'il n'existe pas
            if (!isset($_SESSION['panier'])) {
                $_SESSION['panier'] = [];
            }

            // Ajouter ou mettre à jour la quantité
            if (isset($_SESSION['panier'][$platId])) {
                $_SESSION['panier'][$platId] += $quantite;
            } else {
                $_SESSION['panier'][$platId] = $quantite;
            }

            header('Location: /panier');
            exit;
        }
    }

    // Supprimer un plat du panier
    public function supprimerDuPanier() {
        session_start();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $platId = $_POST['plat_id'];

            if (isset($_SESSION['panier'][$platId])) {
                unset($_SESSION['panier'][$platId]);
            }

            header('Location: /panier');
            exit;
        }
    }

    // Vider le panier (optionnel)
    public function viderPanier() {
        session_start();
        unset($_SESSION['panier']);
        header('Location: /panier');
        exit;
    }
}

