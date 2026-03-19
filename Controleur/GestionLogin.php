<?php
require_once __DIR__ . '/../Modele/DAO/authapi.php';
require_once __DIR__ . '/../Modele/DAO/jwt_utils.php';

$jwt = $_COOKIE['jwt'] ?? null; // get token from cookie
$secret = "secret_key"; // same secret used to generate JWT

if ($jwt && is_jwt_valid($jwt, $secret)) {
    header('Location: /index.php'); // user is valid
    exit;
} else {
    // either no token or invalid/expired token
    $error = seConnecter(); // show login form
}
?>