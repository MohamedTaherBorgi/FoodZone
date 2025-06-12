<?php
session_start();
require_once '../../models/Commande.php';
require_once '../../models/Livraison.php';

// Vérifier que l'admin est connecté
if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    header('Location: login.php');
    exit;
}

$commandeModel = new Commande();
$livraisonModel = new Livraison();

$commandes = $commandeModel->getAllCommandes();
?>

<h2>Gestion des commandes</h2>

<table border="1" cellpadding="5" cellspacing="0">
    <thead>
        <tr>
            <th>Commande #</th>
            <th>Client</th>
            <th>Date</th>
            <th>Adresse</th>
            <th>Prix Total</th>
            <th>Statut Livraison</th>
            <th>Livreur</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($commandes as $commande): 
            // Récupérer la livraison associée
            $livraison = $livraisonModel->getLivraisonByCommandeId($commande['id']);
        ?>
        <tr>
            <td><?= $commande['id'] ?></td>
            <td><?= htmlspecialchars($commande['nom_client']) ?></td>
            <td><?= $commande['date_commande'] ?></td>
            <td><?= htmlspecialchars($commande['adresse_client']) ?></td>
            <td><?= number_format($commande['prix_total'], 2) ?> €</td>
            <td><?= $livraison['statut'] ?? 'Non affectée' ?></td>
            <td><?= $livraison['nom_livreur'] ?? 'Non affecté' ?></td>
            <td>
                <form action="../../controllers/CommandeController.php" method="POST" style="display:inline;">
                    <input type="hidden" name="commande_id" value="<?= $commande['id'] ?>">
                    <select name="livreur_id" required>
                        <option value="">Choisir livreur</option>
                        <?php
                        // Récupérer la liste des livreurs
                        require_once '../../models/User.php';
                        $userModel = new User();
                        $livreurs = $userModel->getUsersByRole('livreur');
                        foreach ($livreurs as $livreur) {
                            echo "<option value=\"{$livreur['id']}\">" . htmlspecialchars($livreur['nom']) . "</option>";
                        }
                        ?>
                    </select>
                    <button type="submit" name="action" value="assigner_livreur">Affecter</button>
                </form>

                <form action="../../controllers/LivraisonController.php" method="POST" style="display:inline;">
                    <input type="hidden" name="commande_id" value="<?= $commande['id'] ?>">
                    <select name="statut" required>
                        <option value="">Changer statut</option>
                        <option value="confirmée">Confirmée</option>
                        <option value="livrée">Livrée</option>
                        <option value="annulée">Annulée</option>
                    </select>
                    <button type="submit" name="action" value="changer_statut">Mettre à jour</button>
                </form>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
