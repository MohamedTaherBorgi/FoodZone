<?php
require_once '../../config/Database.php';
require_once '../models/User.php';
require_once '../models/UserManager.php';

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get POST data
    $id = $_POST['id'];
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $telephone = $_POST['telephone'];
    $email = $_POST['email'];
    $role = $_POST['role'];

    // Validate the inputs (you can add more validation as needed)
    if (empty($nom) || empty($prenom) || empty($telephone) || empty($email)) {
        echo "Please fill in all fields.";
        exit;
    }

    // Create a User object
    $user = new User($nom, $prenom, $telephone, $email, "", $role); // Password is not being updated here

    // Create a Database connection
    $db = new Database();
    $conn = $db->getConnection();

    // Create UserManager object
    $userManager = new UserManager($conn);

    // Call the update method
    $updated = $userManager->updateUser($id, $user);

    // Check if the update was successful
    if ($updated) {
        // Redirect to a success page or show a success message
        header('Location: ../../public/admin_index.php'); // Replace with the actual page you want to redirect to
        exit;
    } else {
        // Show an error message if update failed
        echo "Error updating user.";
    }
}
?>