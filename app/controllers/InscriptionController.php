<?php
// Data

// Appel à la vue
function afficherInscription(){

$pageTitre  = "Inscription";
$metaDescription  = "Vous êtes sur la page d'inscription";


require_once CONTROLLERS .  "BaseController.php";
require_once VIEWS  . "InscriptionView.php";
}