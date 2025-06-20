<?php
ini_set('session.use_strict_mode', 1);
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'domain' => '',
    'secure' => false, // true en production
    'httponly' => true,
    'samesite' => 'Lax'
]);
session_start();

function connecter_utilisateur($utilisateurId) {
    $_SESSION['utilisateurId'] = $utilisateurId;
}

function est_connecte() {
    return isset($_SESSION['utilisateurId']);
}

function deconnecter_utilisateur() {
    unset($_SESSION['utilisateurId']);
    session_destroy();
}