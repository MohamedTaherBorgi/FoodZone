<?php

class Categorie
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // 🔸 Créer une nouvelle catégorie
    public function create($nom)
    {
        $sql = "INSERT INTO categories (nom) VALUES (:nom)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        return $stmt->execute();
    }

    // 🔸 Obtenir toutes les catégories
    public function getAll()
    {
        $sql = "SELECT * FROM categories";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔸 Obtenir une catégorie par son ID
    public function getById($id)
    {
        $sql = "SELECT * FROM categories WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🔸 Mettre à jour une catégorie
    public function update($id, $nom)
    {
        $sql = "UPDATE categories SET nom = :nom WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // 🔸 Supprimer une catégorie
    public function delete($id)
    {
        $sql = "DELETE FROM categories WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }
}
