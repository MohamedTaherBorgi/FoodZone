<?php
require_once 'User.php';

class Livreur extends User {
    public function __construct($nom, $prenom, $email, $password) {
        parent::__construct($nom, $prenom, $email, $password, "livreur");
    }

    public function deliverOrder() {
        // Livreur-specific logic
    }
}
