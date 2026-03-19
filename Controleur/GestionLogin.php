<?php
// auth.php lives in Modele/DAO
require_once __DIR__ . '/../Modele/DAO/authapi.php';
require_once __DIR__ . '/../Modele/DAO/jwt_utils.php';


if (is_jwt_valid($jwt, "secret_key")) {
    header('Location: /index.php');
    exit;
}


$error = seConnecter();


?>