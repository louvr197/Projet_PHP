<?php
// Contrôleur de la page de connexion utilisateur

require_once CORE . 'GestionFormulaire.php';
require_once MODELS . 'UtilisateurModel.php';
require_once CORE . 'gestionAuthentification.php';

/**
 * Affiche la page de connexion et traite le formulaire de connexion.
 */
function afficherConnexion()
{
    // Si l'utilisateur est déjà connecté, on le redirige vers son profil
    if (est_connecte()) {
        header('Location: /profil');
        exit;
    }

    // Définition des règles de validation pour le formulaire de connexion
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

    $errorMessage = []; // Tableau des messages d'erreur pour chaque champ
    $statut = '';       // Message de statut global (succès ou erreur générale)

    // Traitement du formulaire si la requête est en POST
    if ($_SERVER['REQUEST_METHOD'] === "POST") {
        $errorMessage = verifieConditions($conditionsConnexion);

        if (empty($errorMessage)) {
            // Récupération des données du formulaire
            $pseudo = $_POST['pseudo'];
            $mdp = $_POST['mdp'];

            // Recherche de l'utilisateur en base par son pseudo
            $utilisateur = selectionnerUtilisateurParSonPseudo($pseudo);

            // Vérification du mot de passe
            if ($utilisateur && password_verify($mdp, $utilisateur['uti_motdepasse'])) {
                $statut = "Connexion réussie !";
                connecter_utilisateur($utilisateur['uti_id']); // Enregistre l'utilisateur en session
                header('Location: /profil'); // Redirige vers la page de profil
                exit;
            } else {
                $statut = "Identifiants incorrects.";
            }
        } else {
            $statut = "Le formulaire n'a pas été envoyé !";
        }

        // Affichage des variables de debug si DEV_MODE est activé
        if (DEV_MODE) {
            echo "<pre>";
            print_r($_POST);
            print_r($statut);
            print_r($errorMessage);
            echo "</pre>";
        }
    }

    // Variables pour la vue
    $pageTitre  = "Connexion";
    $metaDescription  = "Vous êtes sur la page de connexion";

    // Inclusion du contrôleur de base (pour la navigation) et de la vue
    require_once CONTROLLERS . "BaseController.php";
    require_once VIEWS . "ConnexionView.php";
}