<?php
require_once dirname(__DIR__) . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'config.php';
$configBdd = obtenirConfigBdd();
require_once CORE . "GestionErreur.php";
$nomDuServeur = $configBdd["serveur"];
$nomUtilisateur = $configBdd["utilisateur"];
$motDePasse = $configBdd["mdp"];
$nomBDD = $configBdd["bdd"];
try {
    // Construction du DSN (Data Source Name).
    $dsn = "mysql:host=$nomDuServeur;charset=utf8mb4";

    // Instancier une nouvelle connexion.
    $pdo = new PDO($dsn, $nomUtilisateur, $motDePasse);

    // Définir le mode d'erreur sur "exception".
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Exécuter la requête SQL pour créer la base de données "bdd_ifosup".
    $pdo->exec("CREATE DATABASE $nomBDD DEFAULT CHARACTER SET utf8mb4 DEFAULT COLLATE utf8mb4_general_ci;");
} catch (PDOException $e) {
    echo "Erreur d'exécution de requête : " . $e->getMessage() . PHP_EOL;
}

try {
    // Construction du DSN (Data Source Name).
    $dsn = "mysql:host=$nomDuServeur;dbname=$nomBDD;charset=utf8mb4";

    // Instancier une nouvelle connexion.
    $pdo = new PDO($dsn, $nomUtilisateur, $motDePasse);

    // Définir le mode d'erreur sur "exception".
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $requete = "CREATE TABLE t_utilisateur_uti (
        uti_id INT AUTO_INCREMENT PRIMARY KEY,
        uti_pseudo VARCHAR(255) UNIQUE NOT NULL,
        uti_email VARCHAR(255) UNIQUE NOT NULL,
        uti_motdepasse VARBINARY(255) NOT NULL,
        uti_compte_active BOOLEAN DEFAULT 1,
        uti_code_activation CHAR(5)
    ) ENGINE=InnoDB";

    // Exécuter la requête SQL pour créer la table "t_utilisateur_uti".
    $pdo->exec($requete);
} catch (PDOException $e) {
    echo "Erreur d'exécution de requête : " . $e->getMessage() . PHP_EOL;
}
