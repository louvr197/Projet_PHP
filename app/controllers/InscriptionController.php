<?php
// Data

// Appel à la vue
require_once CORE . 'gestionAuthentification.php';
if (est_connecte()) {
    header('Location: /profil');
    exit;
}
require_once(CORE . 'GestionFormulaire.php');
function afficherInscription()
{

    $conditionsInscription = [
        "pseudo" => [
            "required" => true,
            "minlength" => 2,
            "maxlength" => 255,
            "unique" => [
                "table" => "t_utilisateur_uti",
                "colonne" => "uti_pseudo"
            ]
        ],
        "mail" => [
            "required" => true,
            "email" => true,
            "unique" => [
                "table" => "t_utilisateur_uti",
                "colonne" => "uti_email"
            ]
        ],
        "mdp" => [
            "required" => true,
            "minlength" => 8,
            "maxlength" => 72
        ],
        "confirmMdp" => [
            "required" => true,
            "minlength" => 8,
            "maxlength" => 72,
            "confirm" => "mdp"
        ]

    ];
    $errorMessage = [];
    $statut = '';
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $errorMessage = verifieConditions($conditionsInscription);
        if (empty($errorMessage)) {
            // Création de l'utilisateur
            $pseudo = $_POST['pseudo'];
            $email = $_POST['mail'];
            $mdp = $_POST['mdp'];
            if (creerUtilisateur($pseudo, $email, $mdp)) {
                $statut = "Inscription réussie !";
            } else {
                $statut = "Erreur lors de l'inscription.";
            }
        } else {
            $statut = "Le formulaire n'a pas été envoyé !";
        }
        if (DEV_MODE) {
            echo "<pre>";
            print_r($statut);
            print_r($_POST);
            print_r($errorMessage);
            echo "</pre>";
        }
    }
    $pageTitre  = "Inscription";
    $metaDescription  = "Vous êtes sur la page d'inscription";


    require_once CONTROLLERS .  "BaseController.php";
    require_once VIEWS  . "InscriptionView.php";
}
