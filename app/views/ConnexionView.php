<?php

require_once TEMPLATE . 'header.php';

?>

<h1>Connexion</h1>
<form class="contactForm" method="post">
    <label for="pseudo">Pseudo :</label>
    <p class="errorMessage"><?= $errorMessage["pseudo"] ?? null ?></p>
    <input type="text" id="pseudo" name="pseudo" required minlength="2" maxlength="255"
        <?php
        if (sizeof($errorMessage) != 0) {
            if (!isset($errorMessage["pseudo"])) echo "value='" . htmlspecialchars($_POST["pseudo"]) . "'";
            else echo "aria-invalid='true'";
        }
        ?>>

    <label for="mdp">Mot de passe :</label>
    <p class="errorMessage"><?= $errorMessage["mdp"] ?? null ?></p>
    <input type="password" id="mdp" name="mdp" required minlength="8" maxlength="72"
        <?php
        if (sizeof($errorMessage) != 0) {
            if (!isset($errorMessage["mdp"])) echo "value='" . htmlspecialchars($_POST["mdp"]) . "'";
            else echo "aria-invalid='true'";
        }
        ?>>

    <input type="submit" value="se connecter">

</form>

<?php require_once TEMPLATE . 'footer.php'; ?>