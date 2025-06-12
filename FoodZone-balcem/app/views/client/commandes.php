<?php
session_start();
require_once '../../models/Commande.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

$commandeModel = new Commande();
$commandes = $commandeModel->getCommandesByUser($_SESSION['user_id']);
?>

<h2>Mes commandes</h2>

<?php if (empty($commandes)): ?>
    <p>Vous n'avez aucune commande.</p>
<?php else: ?>
    <table>
        <thead>
            <tr>
                <th>Commande #</th>
                <th>Date</th>
                <th>Adresse</th>
                <th>Prix Total</th>
                <th>Statut Livraison</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($commandes as $commande): ?>
            <tr>
                <td><?= $commande['id'] ?></td>
                <td><?= $commande['date_commande'] ?></td>
                <td><?= htmlspecialchars($commande['adresse_client']) ?></td>
                <td><?= number_format($commande['prix_total'], 2) ?> €</td>
                <td>
                    <!-- Statut à récupérer via livraison si besoin -->
                    <?php
                    // Par défaut, on peut afficher "En cours" si pas encore livré
                    echo $commande['statut'] ?? "En cours";
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php endif; ?>
