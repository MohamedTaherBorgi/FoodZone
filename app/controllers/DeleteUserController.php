<?php
// Include database configuration and UserManager
require_once '../../config/Database.php';
require_once '../models/UserManager.php';

if (isset($_GET['id'])) {
    $id = $_GET['id']; // Get the user ID from the URL

    // Create a Database connection
    $db = new Database();
    $conn = $db->getConnection();

    // Create UserManager object
    $userManager = new UserManager($conn);

    // Call the delete method (you can create this method inside the UserManager class)
    $deleteSuccess = $userManager->deleteUser($id);

    // Redirect to the users list page or show a success message
    if ($deleteSuccess) {
        header('Location: ../../public/admin_index.php'); // Redirect to the users list page (replace with your actual page)
        exit;
    } else {
        echo "Error deleting user.";
    }
}
?>