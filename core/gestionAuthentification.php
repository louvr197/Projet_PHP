<?php

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