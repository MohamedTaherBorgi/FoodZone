<?php
require_once '../models/User.php';

class UserManager
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getUserById($id)
    {
        $stmt = $this->conn->prepare("SELECT * FROM user WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $user = new User($row['nom'], $row['prenom'], $row['telephone'], $row['email'], $row['password'], $row['role']);
            return ['user' => $user, 'id' => $row['id']];
        }

        return null;
    }

    public function updateUser($id, User $user)
    {
        $stmt = $this->conn->prepare("UPDATE user SET nom = ?, prenom = ?, telephone = ?, email = ?, role = ? WHERE id = ?");
        return $stmt->execute([
            $user->getNom(),
            $user->getPrenom(),
            $user->getTelephone(),
            $user->getEmail(),
            $user->getRole(),
            $id
        ]);
    }

    public function deleteUser($id)
    {
        // Prepare the SQL query to delete the user by ID
        $stmt = $this->conn->prepare("DELETE FROM user WHERE id = ?");

        // Execute the query with the given ID
        return $stmt->execute([$id]);
    }
}
