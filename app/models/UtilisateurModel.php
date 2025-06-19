<?php

require_once CORE . "GestionBdd.php";

function obtenirNomTable(): string
{
    return 't_utilisateur_uti';
}


function obtenirReglesFormInscription(): array
{
    $table = obtenirNomTable();

    return [
        'pseudo' => [
            'requis' => true,
            'unique' => [
                'table' => $table,
                'colonne' => 'uti_pseudo'
            ],
            'minLength' => 2,
            'maxLength' => 255
        ],
        'email' => [
            'requis' => true,
            'unique' => [
                'table' => $table,
                'colonne' => 'uti_email'
            ],
            'type' => 'email'
        ],
        'mdp' => [
            'requis' => true,
            'type' => 'password',
            'minLength' => 8,
            // Pour des raisons de compatibilité avec les futurs algorithmes (ex. Argon2id),
            // on autorise jusqu'à 255 caractères. Cependant, avec Bcrypt (algorithme par défaut actuel),
            // seuls les 72 premiers caractères sont pris en compte dans le hash.
            'maxLength' => 255
        ]
    ];
}

function obtenirReglesFormConnexion(): array
{
    $table = obtenirNomTable();

    return [
        'pseudo' => [
            'requis' => true,
            'minLength' => 2,
            'maxLength' => 255
        ],
        'motDePasse' => [
            'requis' => true,
            'type' => 'password',
            'minLength' => 8,
            'maxLength' => 255
        ]
    ];
}

/* Toutes les requêtes SQL pour la table Utilisateur */

function creerUtilisateur(string $pseudo, string $email, string $mdp): bool
{
    $table = obtenirNomTable();
    $requete = "INSERT INTO $table (uti_pseudo, uti_email, uti_motdepasse) VALUES (:pseudo, :email, :motDePasse)";

    // Hashage du mot de passe.
    $mdp = password_hash($mdp, PASSWORD_DEFAULT);

    // Fonction générique présente dans le gestionnaire de base de données (gestionBdd).
    return modifierDansTable($requete, [
        'pseudo' => $pseudo,
        'email' => $email,
        'motDePasse' => $mdp
    ]);
}


function selectionnerUtilisateurParSonPseudo(string $pseudo): ?array
{
    $table = obtenirNomTable();
    $requete = "SELECT * FROM $table WHERE uti_pseudo = :pseudo";
    return selectionnerDansTable($requete, ['pseudo' => $pseudo]);
}

function selectionnerUtilisateurParId($id) {
    $pdo = obtenirConnexionBdd();
    $stmt = $pdo->prepare("SELECT uti_pseudo, uti_email FROM t_utilisateur_uti WHERE uti_id = :id");
    $stmt->execute(['id' => $id]);
    return $stmt->fetch(PDO::FETCH_ASSOC);
}

function supprimerUtilisateur(int $id): bool
{
    $table = obtenirNomTable();
    $requete = "DELETE FROM $table WHERE uti_id = :id";

    // Fonction générique présente dans le gestionnaire de base de données (gestionBdd).
    return modifierDansTable($requete, ['id' => $id]);
}
