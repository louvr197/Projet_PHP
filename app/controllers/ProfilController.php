<?php
require_once CORE . 'gestionAuthentification.php';
require_once MODELS . 'UtilisateurModel.php';

function afficherProfil() {
    if (!est_connecte()) {
        header('Location: /connexion');
        exit;
    }
    $utilisateurId = $_SESSION['utilisateurId'];
    $utilisateur = selectionnerUtilisateurParId($utilisateurId);
    $pageTitre  = "Profil de " . htmlspecialchars($utilisateur['uti_pseudo']);
    $metaDescription  = "Page de profil de l'utilisateur " . htmlspecialchars($utilisateur['uti_pseudo']) . ".";


    require_once CONTROLLERS .  "BaseController.php";
    require_once VIEWS . 'ProfilView.php';
}
?>