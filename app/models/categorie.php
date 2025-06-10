<?php
require_once __DIR__ . '/../../config/Database.php';

class Categorie
{
    private $db;

    public function __construct()
    {
        // On récupère l'instance PDO de la DB
        $this->db = Database::getInstance();
    }

    public function create($nom)
    {
        $sql = "INSERT INTO categories (nom) VALUES (:nom)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        return $stmt->execute();
    }

    public function getAll()
    {
        $sql = "SELECT * FROM categories";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $sql = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id, $nom)
    {
        $sql = "UPDATE categories SET nom = :nom WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    public function delete($id)
    {
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
