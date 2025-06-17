<?php
// Data

require_once(CORE.'GestionFormulaire.php');
// Appel à la vue
function afficherConnexion()
{

    $conditionsInscription = [
        "pseudo" => ["required" => true, "minlength" => 2, "maxlength" => 255],
        "mdp" => ["required" => true, "minlength" => 8, "maxlength" => 72],

    ];
    $errorMessage = [];
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $errorMessage = verifieConditions($conditionsInscription);
        if (sizeof($errorMessage) === 0) {
            if (mailContact()) $statut = "Le formulaire et le mail ont bien été envoyé !";
            else $statut = "Le mail n'a pas été envoyé";
        } else {
            $statut = "Le formulaire n'a pas été envoyé !";
        }
        if (DEBUG) {
            echo "<pre>";
            print_r($_POST);
            print_r($errorMessage);
            echo "</pre>";
        }
    }
    $pageTitre  = "Inscription";
    $metaDescription  = "Vous êtes sur la page d'inscription";


    require_once CONTROLLERS .  "BaseController.php";
    require_once VIEWS  . "ConnexionView.php";
}
