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
        "confirmMdp"=>
        strcmp($_POST[$champ],$_POST["mdp"])===0,
        default => false
    };
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
                    $errorMessage[$champ] = 'la condition "' . $condition  . '"' . " n'est pas respectée.";
                }
            }
        }
    }
    return $errorMessage;
}
