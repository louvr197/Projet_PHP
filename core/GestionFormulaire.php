<?php
function respecteCondition($condition, $champ, $value = null): bool
{
    // echo strcmp($_POST["confirmMdp"],$_POST["mdp"]);
    return match ($condition) {
        "set" => isset($_POST[$champ]),
        "required" =>
        !empty($_POST[$champ]),
        "minlength" =>
        mb_strlen($_POST[$champ]) >= $value,
        "maxlength" =>
        mb_strlen($_POST[$champ]) <= $value,
        "email" => filter_var($_POST[$champ], FILTER_VALIDATE_EMAIL),
        "confirm" =>
        strcmp($_POST[$champ], $_POST[$value]) === 0,
        "unique" =>
        estDansBdd($champ, $value) == 0,
        default => false
    };
}

function estDansBdd($champ,$value)
{
    require_once MODELS . 'UtilisateurModel.php';
    $table = $value['table'];
    $colonne = $value['colonne'];
    $requete = "SELECT COUNT(*) FROM $table WHERE $colonne = :valeur";
    $pdo = obtenirConnexionBdd();
    $stmt = $pdo->prepare($requete);
    $stmt->execute(['valeur' => $_POST[$champ]]);
    return $stmt->fetchColumn();
}



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
                    switch ($condition) {
                        case 'required':
                            $msg = "Ce champ est obligatoire.";
                            break;
                        case 'minlength':
                            $msg = "Ce champ doit contenir au moins $value caractères.";
                            break;
                        case 'maxlength':
                            $msg = "Ce champ doit contenir au maximum $value caractères.";
                            break;
                        case 'email':
                            $msg = "Veuillez saisir une adresse email valide.";
                            break;
                        case 'confirm':
                            $msg = "Les deux champs ne correspondent pas.";
                            break;
                        case 'unique':
                            $msg = "Cette valeur est déjà utilisée.";
                            break;
                        default:
                            $msg = "La condition \"$condition\" n'est pas respectée.";
                    }
                    $errorMessage[$champ] = $msg;
                }
            }
        }
    }
    return $errorMessage;
}
