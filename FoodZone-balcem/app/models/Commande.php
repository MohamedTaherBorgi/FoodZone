<?php
class Commande {
    private $pdo;

    public function __construct() {
        // Connexion PDO à la base MySQL
        $host = 'localhost';
        $dbname = 'foodzone';
        $username = 'root';  // adapte selon ta config
        $password = '';      // adapte selon ta config

        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            // Mode erreur Exception
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    // Récupérer toutes les commandes (pour admin)
    public function getAllCommandes() {
        $stmt = $this->pdo->query("SELECT * FROM commandes ORDER BY date_commande DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Récupérer commandes par user
    public function getCommandesByUser($userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM commandes WHERE user_id = :user_id ORDER BY date_commande DESC");
        $stmt->execute(['user_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Créer une commande
    public function creerCommande($userId, $platsChoisis, $prixTotal, $adresse) {
        // $platsChoisis est un tableau d'ids plats, on convertit en JSON par exemple
        $platsJson = json_encode($platsChoisis);
        $dateCommande = date('Y-m-d H:i:s');

        $sql = "INSERT INTO commandes (user_id, plats_choisis, prix_total, date_commande, adresse_client)
                VALUES (:user_id, :plats_choisis, :prix_total, :date_commande, :adresse_client)";

        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            'user_id' => $userId,
            'plats_choisis' => $platsJson,
            'prix_total' => $prixTotal,
            'date_commande' => $dateCommande,
            'adresse_client' => $adresse
        ]);
    }

    // Calculer le prix total (tu peux adapter en récupérant les prix dans la table plats)
    public function calculerPrixTotal($platsChoisis) {
        if (empty($platsChoisis)) {
            return 0;
        }

        // Récupérer le prix de chaque plat et multiplier par quantité
        $total = 0;
        $inQuery = implode(',', array_fill(0, count($platsChoisis), '?'));

        $sql = "SELECT id, prix FROM plats WHERE id IN ($inQuery)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute(array_keys($platsChoisis));

        $prixParPlat = [];
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $prixParPlat[$row['id']] = $row['prix'];
        }

        foreach ($platsChoisis as $platId => $quantite) {
            $prix = $prixParPlat[$platId] ?? 0;
            $total += $prix * $quantite;
        }

        return $total;
    }
}
