<?php
require_once 'User.php';

class Admin extends User {
    public function __construct($nom, $prenom, $email, $password) {
        parent::__construct($nom, $prenom, $email, $password, "admin");
    }

    public function manageUsers() {
        // Admin-specific logic
    }
}
