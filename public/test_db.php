<?php
require_once '../config/Database.php';

$db = new Database();
$conn = $db->getConnection();

if ($conn) {
    echo "✅ Connexion à la base de données réussie !";
} else {
    echo "❌ Connexion échouée.";
}
