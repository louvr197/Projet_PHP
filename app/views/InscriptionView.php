<?php

require_once TEMPLATE . 'header.php';

?>

<h1>Inscription</h1>
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


    <label for="mail">Email :</label>
    <p class="errorMessage"><?= $errorMessage["mail"] ?? null ?></p>

    <input type="email" name="mail" id="mail" required
        <?php
        if (sizeof($errorMessage) != 0) {
            if (!isset($errorMessage["mail"])) echo "value='" . htmlspecialchars($_POST["mail"]) . "'";
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
    <label for="confirmMdp">Confirmation du Mot de passe :</label>
    <p class="errorMessage"><?= $errorMessage["confirmMdp"] ?? null ?></p>
    <input type="password" id="confirmMdp" name="confirmMdp" required minlength="8" maxlength="72"
        <?php
        if (sizeof($errorMessage) != 0) {
            if (!isset($errorMessage["confirmMdp"])) echo "value='" . htmlspecialchars($_POST["confirmMdp"]) . "'";
            else echo "aria-invalid='true'";
        }
        ?>>


</form>

<?php require_once TEMPLATE . 'footer.php'; ?>