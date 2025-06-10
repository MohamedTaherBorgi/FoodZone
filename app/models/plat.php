<?php

class Plat
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    // 🔸 Créer un plat
    public function create($nom, $description, $prix, $image, $categorie_id)
    {
        $sql = "INSERT INTO plats (nom, description, prix, image, categorie_id)
                VALUES (:nom, :description, :prix, :image, :categorie_id)";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':categorie_id', $categorie_id);
        return $stmt->execute();
    }

    // 🔸 Obtenir tous les plats
    public function getAll()
    {
        $sql = "SELECT p.*, c.nom AS categorie_nom
                FROM plats p
                JOIN categories c ON p.categorie_id = c.id";
        return $this->db->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔸 Obtenir un plat par son ID
    public function getById($id)
    {
        $sql = "SELECT * FROM plats WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🔸 Mettre à jour un plat
    public function update($id, $nom, $description, $prix, $image, $categorie_id)
    {
        $sql = "UPDATE plats
                SET nom = :nom, description = :description, prix = :prix,
                    image = :image, categorie_id = :categorie_id
                WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':image', $image);
        $stmt->bindParam(':categorie_id', $categorie_id);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // 🔸 Supprimer un plat
    public function delete($id)
    {
        $sql = "DELETE FROM plats WHERE id = :id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id);
        return $stmt->execute();
    }

    // 🔸 Obtenir les plats d'une catégorie
    public function getByCategorie($categorie_id)
    {
        $sql = "SELECT * FROM plats WHERE categorie_id = :categorie_id";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':categorie_id', $categorie_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
