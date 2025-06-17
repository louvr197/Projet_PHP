
<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR.'config'.DIRECTORY_SEPARATOR.'constantes.php';

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$methode = $_SERVER['REQUEST_METHOD'];

if ($uri === '/' && $methode === 'GET')
{
    require_once CONTROLLERS . 'AccueilController.php';
    afficherAccueil();
}
else if ($uri === '/contact' ){
    require_once CONTROLLERS.'ContactController.php';
    afficherContact();
}
else if($uri === '/inscription') {
    require_once CONTROLLERS.'InscriptionController.php';
    afficherInscription();
}else if($uri === '/connexion') {
    require_once CONTROLLERS.'ConnexionController.php';
    afficherConnexion();
}
else echo $uri;




// /public/index.php

// Importer le routeur.
// require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR . 'Routeur.php';

// // Définir les routes : chaque route est associée à une méthode HTTP, une URL, un contrôleur et une fonction.
// $routes = [
//     configurerRoute('GET', '/', 'AccueilController', 'afficherAccueil'),
//     configurerRoute('GET', '/contact', 'ContactController', 'afficherContact'),
//     configurerRoute('POST', '/contact', 'ContactController', 'traiterContact'),
//     configurerRoute('GET', '/connexion', 'utilisateur/ConnexionController', 'afficherConnexion'),
//     configurerRoute('POST', '/connexion', 'utilisateur/ConnexionController', 'traiterConnexion'),
//     configurerRoute('GET', '/erreur', 'ErreurController', 'afficherErreur404'),
// ];

// // Lancer le routeur.
// demarrerRouteur($routes);
?>