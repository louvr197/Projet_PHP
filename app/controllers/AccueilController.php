<?php
// Data

// Appel à la vue
function afficherAccueil(){

$pageTitre  = "Accueil";
$metaDescription  = "Vous êtes sur la page d'accueil";


require_once CONTROLLERS .  "BaseController.php";
require_once VIEWS  . "accueilView.php";
}