<?php


function obtenirConnexionBdd(): PDO
{
    // Récupérer la configuration permettant d'établir une connexion à la base de données.
    $config = obtenirConfigBdd();

    // Construire le DSN (Data Source Name).
    $dsn = "mysql:host={$config['serveur']};dbname={$config['bdd']};charset=utf8mb4";

    // Établir connexion à la base de données.
    $pdo = new PDO($dsn, $config['utilisateur'], $config['mdp']);

    // Activer les Exceptions en cas d'erreur.
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    return $pdo;
}


function selectionnerDansTable($requete, $data){
    try
{
    // Instancier la connexion à la base de données.
    $pdo = obtenirConnexionBdd();



    // Préparation de la requête SQL.
    $stmt = $pdo->prepare($requete);



    foreach($data as $key => $value){
    $stmt->bindValue(':'.$key, $value);
    }
    // Exécution de la requête.

    $stmt->execute();

    $resultat = $stmt->fetch(PDO::FETCH_ASSOC);


    if ($resultat)
    {
        return $resultat;
    }
}
catch(PDOException $e)
{
    gererExceptions($e);
}
finally
{
    // Libérer la connexion, que le bloc try se soit exécuté entièrement ou qu'une exception ait été capturée.
    $pdo = null;
}
}


function modifierDansTable($requete, $data) {
    try {
        $pdo = obtenirConnexionBdd();
        $stmt = $pdo->prepare($requete);
        foreach ($data as $key => $value) {
            $stmt->bindValue(':' . $key, $value);
        }
        $stmt->execute();
        return $stmt->rowCount();
    } catch (PDOException $e) {
        gererExceptions($e);
        return false;
    } finally {
        $pdo = null;
    }
}
?>