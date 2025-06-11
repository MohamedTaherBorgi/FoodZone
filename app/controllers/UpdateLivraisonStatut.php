<?php
include_once '../../config/Database.php';
require '../../vendor/autoload.php'; // Mailjet SDK

use \Mailjet\Resources;

$db = new Database();
$conn = $db->getConnection();

// Get ID and new status from URL
$id = $_GET['id'] ?? 0;
$newStatut = $_GET['statut'] ?? '';

$allowed = ['EN_ATTENTE', 'EN_COURS', 'LIVREE', 'ANNULEE'];

if ($id && in_array($newStatut, $allowed)) {
    // Update statut
    $query = "UPDATE livraison SET statut = :statut WHERE id = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':statut', $newStatut);
    $stmt->bindParam(':id', $id);
    $stmt->execute();

    // Fetch client email associated with the livraison
    $query2 = "
    SELECT u.email AS client_email
    FROM livraison l
    JOIN commande c ON l.idCommande = c.idCommande
    JOIN user u ON c.idClient = u.id
    WHERE l.id = :id
    ";

    $stmt2 = $conn->prepare($query2);
    $stmt2->bindParam(':id', $id, PDO::PARAM_INT);
    $stmt2->execute();

    $client = $stmt2->fetch(PDO::FETCH_ASSOC);


    if ($client && !empty($client['client_email'])) {
        $clientEmail = $client['client_email'];

        // Mailjet API keys (replace with your real keys or getenv)
        $apiKeyPublic = 'f61f3fb9c5a59276f2a09ef620c94249';
        $apiKeyPrivate = '6844b2a0f45ff29f755f7363cb7acce8';

        $mj = new \Mailjet\Client($apiKeyPublic, $apiKeyPrivate, true, ['version' => 'v3.1']);

        $body = [
            'Messages' => [
                [
                    'From' => [
                        'Email' => "medtaherborgi@gmail.com",
                        'Name' => "Food Zone"
                    ],
                    'To' => [
                        [
                            'Email' => $clientEmail,
                            'Name' => "Client"
                        ]
                    ],
                    'Subject' => "Mise à jour de l'état de votre livraison",
                    'TextPart' => "Bonjour, l'état de votre livraison a été mis à jour : $newStatut",
                    'HTMLPart' => "<h3>Bonjour,</h3><p>L'état de votre livraison a été mis à jour : <strong>$newStatut</strong>.</p><p>Merci de votre confiance !</p>"
                ]
            ]
        ];

        $response = $mj->post(Resources::$Email, ['body' => $body]);

        if (!$response->success()) {
            error_log("Failed to send delivery status email to client: " . $response->getStatus());
        }
    }
}

// Redirect back to livreur dashboard
header("Location: ../../public/livreur_index.php");
exit;