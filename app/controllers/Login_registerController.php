<?php
class Login_registerController
{
    public function login()
    {
        if (isset($_SESSION['user_id'])) {
            // Check the user role
            if ($_SESSION['role'] == 'admin') {
                header('Location: admin_index.php');  // Redirect to admin dashboard
                exit();
            } elseif ($_SESSION['role'] == 'client') {
                header('Location: index.php');  // Redirect to client dashboard
                exit();
            } elseif ($_SESSION['role'] == 'livreur') {
                header('Location: livreur_index.php');  // Redirect to livreur dashboard
                exit();
            }
        }

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
                header("Location: ../app/views/login_register/email_doesnt_exist.php");
                exit();
            }

            // Step 2: Verify the password
            $user = $result->fetch(PDO::FETCH_ASSOC);
            if (password_verify($password, $user['password'])) {
                // Set session variables and redirect
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['role'] = $user['role'];

                // ✅ Set cookie if 'remember' is checked
                if (!empty($_POST['remember'])) {
                    setcookie('user_email', $user['email'], time() + (86400 * 30), "/"); // valid for 30 days
                } else {
                    // If unchecked, clear the cookie
                    if (isset($_COOKIE['user_email'])) {
                        setcookie('user_email', '', time() - 3600, "/");
                    }
                }

                // Redirect based on role
                if ($user['role'] == 'admin') {
                    header('Location: admin_index.php');
                    exit();
                } else if ($user['role'] == 'client') {
                    header('Location: index.php');
                    exit();
                } elseif ($user['role'] == 'livreur') {
                    header('Location: livreur_index.php');
                    exit();
                }
            } else {
                header("Location: ../app/views/login_register/password_wrong.php");
                exit();
            }
        } else {
            // If not POST request, show the login form
            require '../app/views/login_register/login.php';
        }
    }


    public function register()
    {
        if (isset($_SESSION['user_id'])) {
            // Check the user role
            if ($_SESSION['role'] == 'admin') {
                header('Location: admin_index.php');  // Redirect to admin dashboard
                exit();
            } elseif ($_SESSION['role'] == 'client') {
                header('Location: index.php');  // Redirect to client dashboard
                exit();
            } elseif ($_SESSION['role'] == 'livreur') {
                header('Location: livreur_index.php');  // Redirect to livreur dashboard
                exit();
            }
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Get form data
            $nom = $_POST['nom'];
            $prenom = $_POST['prenom'];
            $telephone = $_POST['telephone'];
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
                exit();  // Ensure no further code is executed
            }

            // Step 1: Check if the telephone already exists
            $query = "SELECT * FROM `user` WHERE telephone = '$telephone' LIMIT 1";  // Direct SQL query with the telephone
            $result = $conn->query($query); // Execute the query

            // If the email already exists
            if ($result->rowCount() > 0) {
                // Redirect to email_exists.php
                header('Location: ../app/views/login_register/telephone_exists.php');
                exit();  // Ensure no further code is executed
            }

            // Step 2: Hash the password
            $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

            // Step 3: Insert the new user into the database
            $query = "INSERT INTO `user` (nom, prenom, telephone, email, password, role) 
                      VALUES ('$nom', '$prenom', '$telephone' , '$email' , '$hashedPassword', '$role')"; // Direct SQL query
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