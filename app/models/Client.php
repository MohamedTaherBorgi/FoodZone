<?php 
require_once 'User.php';

class Client extends User {
    public function __construct($nom, $prenom, $email, $password) {
        parent::__construct($nom, $prenom, $email, $password, "client");
    }

    public function orderFood() {
        // Logic for client-specific actions
    }
}