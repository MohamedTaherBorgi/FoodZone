<?php
class Login_registerController {
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get the email and password from the form
            $email = $_POST['email'];
            $password = $_POST['password'];

            include_once '../config/Database.php'; // Include the Database class

            // Database connection
            $db = new Database();
            $conn = $db->getConnection();

            // Step 1: Check if the email exists in the database
            $query = "SELECT * FROM `user` WHERE email = '$email' LIMIT 1"; // Direct SQL query (without bindParam)
            $result = $conn->query($query); // Execute the query

            // If the email does not exist
            if ($result->rowCount() == 0) {
                // Show alert or redirect to login page with an error message
                echo "<script>alert('L\'email n\'existe pas.');</script>";
                return;
            }

            // Step 2: Verify the password
            $user = $result->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['password'])) {
                // Step 3: Set session variables or create a token for the user
                session_start();
                $_SESSION['user_id'] = $user['id']; // Assuming 'id' is the user's unique identifier
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role']; // If you want to store the user's role

                // Redirect to a dashboard or home page
                if($user['role'] == 'admin') {
                    header('Location: admin_index.php');
                    exit;
                } else if($user['role'] == 'client') {
                    header('Location: index.php');
                    exit;
                }elseif($user['role'] == 'livreur') {
                    header('Location: livreur_index.php');
                    exit;
                }
            } else {
                // Password is incorrect
                echo "<script>alert('Mot de passe incorrect.');</script>";
            }
        } else {
            // If not POST request, show the login form
            require '../app/views/login_register/login.php';
        }
    }


    public function register() {
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get form data
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $role = $_POST['role'];

            include_once '../config/Database.php';  // Include the Database class

            // Database connection
            $db = new Database();
            $conn = $db->getConnection();

            // Step 1: Check if the email already exists
            $query = "SELECT * FROM `user` WHERE email = '$email' LIMIT 1";  // Direct SQL query with the email
            $result = $conn->query($query); // Execute the query

            // If the email already exists
            if ($result->rowCount() > 0) {
              // Redirect to email_exists.php
               header('Location: ../app/views/login_register/email_exists.php');        
               exit;  // Ensure no further code is executed
            }

            // Step 2: Hash the password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Step 3: Insert the new user into the database
            $query = "INSERT INTO `user` (nom, prenom, email, password, role) 
                      VALUES ('$nom', '$prenom', '$email', '$hashedPassword', '$role')"; // Direct SQL query
            try {
                // Execute the insert query
                $conn->exec($query); // Using exec() for non-select queries
                header('Location: login_index.php'); // Redirect to login page after successful registration
            } catch (PDOException $exception) {
                echo "Erreur lors de l'inscription: " . $exception->getMessage();
            }
        } else {
            require '../app/views/login_register/register.php';  // Display the form if not POST
        }
    }
}