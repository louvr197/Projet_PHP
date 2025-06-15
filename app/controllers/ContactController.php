<?php

// Appel à la vue
function afficherContact()
{
    // Data
    $pageTitre  = "Contact";
    $metaDescription  = "Vous êtes sur la page de contact";
    $errorMessage=[];
    require_once MODELS."ContactModel.php";
    require_once CONTROLLERS .  "BaseController.php";
    require_once VIEWS  . "ContactView.php";
}
