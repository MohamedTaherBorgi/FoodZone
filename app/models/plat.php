<?php
// app/models/Plat.php

class Plat {
    private static function getDB() {
        try {
            $host = 'localhost';
            $dbname = 'resto_db';      // adapte selon ta config
            $username = 'root';
            $password = '';

            $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {
            die("Erreur de connexion : " . $e->getMessage());
        }
    }

    // 🔹 Récupérer tous les plats
    public static function getAll() {
        $pdo = self::getDB();
        $stmt = $pdo->query("SELECT * FROM plats");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // 🔹 Récupérer un plat par ID
    public static function getById($id) {
        $pdo = self::getDB();
        $stmt = $pdo->prepare("SELECT * FROM plats WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // 🔹 Ajouter un nouveau plat
    public static function insert($data) {
        $pdo = self::getDB();
        $stmt = $pdo->prepare("INSERT INTO plats (nom, description, prix, image, categorie_id) VALUES (?, ?, ?, ?, ?)");
        return $stmt->execute([
            $data['nom'],
            $data['description'],
            $data['prix'],
            $data['image'],         // nom du fichier image
            $data['categorie_id']
        ]);
    }

    // 🔹 Modifier un plat existant
    public static function update($id, $data) {
        $pdo = self::getDB();
        $stmt = $pdo->prepare("UPDATE plats SET nom = ?, description = ?, prix = ?, image = ?, categorie_id = ? WHERE id = ?");
        return $stmt->execute([
            $data['nom'],
            $data['description'],
            $data['prix'],
            $data['image'],         // nom du fichier image
            $data['categorie_id'],
            $id
        ]);
    }

    // 🔹 Supprimer un plat
    public static function delete($id) {
        $pdo = self::getDB();
        $stmt = $pdo->prepare("DELETE FROM plats WHERE id = ?");
        return $stmt->execute([$id]);
    }
}
