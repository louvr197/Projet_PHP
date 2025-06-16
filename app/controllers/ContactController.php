<?php
//     $dictionnaireCondition = [
//     "required" => "champ requis",
//     "minlength" => "longueur minimale",
//     "maxlength" => "longueur maximale",
//     "email" => "email valide"
// ];
require_once(CORE.'GestionEmail.php');
require_once(CORE.'GestionFormulaire.php');
function afficherContact()
{

    $conditionsContact = [
        "nom" => ["required" => true, "minlength" => 2, "maxlength" => 255],
        "prenom" => ["minlength" => 2, "maxlength" => 255],
        "mail" => ["required" => true, "email" => true],
        "message" => ["required" => true, "minlength" => 10, "maxlength" => 3000],

    ];
    $errorMessage = [];
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $errorMessage = verifieConditions($conditionsContact);
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
    // Data
    $pageTitre  = "Contact";
    $metaDescription  = "Vous êtes sur la page de contact";
    require_once CONTROLLERS .  "BaseController.php";
    require_once VIEWS  . "ContactView.php";
}

