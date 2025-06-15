<?php

// Appel à la vue
function afficherContact()
{
    // Data
    $pageTitre  = "Contact";
    $metaDescription  = "Vous êtes sur la page de contact";
    $errorMessage=[];
    require_once CONTROLLERS .  "BaseController.php";
    require_once VIEWS  . "ContactView.php";
}


function respecteCondition($condition, $champ, $value = null): bool
{
    return match ($condition) {
        "set" => isset($_POST[$champ]),
        "required" =>
        !empty($_POST[$champ]),
        "minlength" =>
        mb_strlen($_POST[$champ]) >= $value,
        "maxlength" =>
        mb_strlen($_POST[$champ]) <= $value,
        "email" => filter_var($_POST[$champ], FILTER_VALIDATE_EMAIL)
    };
}


$conditionsContact = [
    "nom" => ["required" => true, "minlength" => 2, "maxlength" => 255],
    "prenom" => ["minlength" => 2, "maxlength" => 255],
    "mail" => ["required" => true, "email" => true],
    "message" => ["required" => true, "minlength" => 10, "maxlength" => 3000],

];

$dictionnaireCondition = [
    "required" => "champ requis",
    "minlength" => "longueur minimale",
    "maxlength" => "longueur maximale",
    "email" => "email valide"
];
function verifieConditions($champs)
{
    $errorMessage = [];
    foreach ($champs as $champ => $conditions) {
        if (
            key_exists("required", $conditions) ||
            (isset($_POST[$champ]) && !empty($_POST[$champ]))
        ) {
            foreach ($conditions as $condition => $value) {
                if (!key_exists($champ, $errorMessage) && !respecteCondition($condition, $champ, $value)) {
                    $errorMessage[$champ] = 'la condition "' . $condition  . '"' . " n'est pas respectée.";
                }
            }
        }
    }
    return $errorMessage;
}



if ($_SERVER['REQUEST_METHOD'] === "POST") {
    $errorMessage = verifieConditions($conditionsContact);
    if (sizeof($errorMessage) === 0) {
        $statut = "Le formulaire a bien été envoyé !";
    } else {
        $statut = "Le formulaire n'a pas été envoyé !";
    }
    if (DEBUG){
    echo "<pre>";
    print_r($_POST);
    print_r($errorMessage);
    echo "</pre>";
    }
}