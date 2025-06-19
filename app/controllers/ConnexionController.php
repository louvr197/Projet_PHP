<?php
// Data

require_once CORE . 'GestionFormulaire.php';
require_once MODELS.'UtilisateurModel.php';
// Appel à la vue
function afficherConnexion()
{

    $conditionsConnexion = [
        "pseudo" => [
            "required" => true,
            "minlength" => 2,
            "maxlength" => 255
        ],
        "mdp" => [
            "required" => true,
            "minlength" => 8,
            "maxlength" => 72
        ],

    ];
    $errorMessage = [];
    $statut = '';
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $errorMessage = verifieConditions($conditionsConnexion);
        if (empty($errorMessage)) {
            $pseudo = $_POST['pseudo'];
            $mdp = $_POST['mdp'];
            $utilisateur = selectionnerUtilisateurParSonPseudo($pseudo);
            if ($utilisateur && password_verify($mdp, $utilisateur['uti_motdepasse'])) {
                $statut = "Connexion réussie !";
                // Ici, tu peux démarrer une session, etc.
            } else {
                $statut = "Identifiants incorrects.";
            }
        } else {
            $statut = "Le formulaire n'a pas été envoyé !";
        }
    }
    $pageTitre  = "Connexion";
    $metaDescription  = "Vous êtes sur la page de connexion";
    if (DEV_MODE) {
        echo "<pre>";
        print_r($_POST);
        print_r($statut);
        print_r($errorMessage);
        echo "</pre>";
    }

    require_once CONTROLLERS .  "BaseController.php";
    require_once VIEWS  . "ConnexionView.php";
}
