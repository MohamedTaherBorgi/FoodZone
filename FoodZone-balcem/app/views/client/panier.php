<?php
session_start();

// Exemple de panier stocké en session :
// $_SESSION['panier'] = [ plat_id => quantite, ... ];
$panier = $_SESSION['panier'] ?? [];

if (empty($panier)) {
    echo "<p>Votre panier est vide.</p>";
    exit;
}

require_once '../../models/Plat.php';
$platModel = new Plat();

$total = 0;
?>

<h2>Votre panier</h2>
<table>
    <thead>
        <tr>
            <th>Plat</th>
            <th>Quantité</th>
            <th>Prix Unitaire</th>
            <th>Sous-total</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($panier as $platId => $quantite): 
            $plat = $platModel->getPlatById($platId);
            $sousTotal = $plat['prix'] * $quantite;
            $total += $sousTotal;
        ?>
        <tr>
            <td><?= htmlspecialchars($plat['nom']) ?></td>
            <td><?= $quantite ?></td>
            <td><?= number_format($plat['prix'], 2) ?> €</td>
            <td><?= number_format($sousTotal, 2) ?> €</td>
            <td>
                <a href="panier.php?action=remove&id=<?= $platId ?>">Supprimer</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<p><strong>Total : <?= number_format($total, 2) ?> €</strong></p>

<a href="commande.php">Passer commande</a>
