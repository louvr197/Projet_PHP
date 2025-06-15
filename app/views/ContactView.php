<?php

require_once __DIR__ . DIRECTORY_SEPARATOR . 'header.php';
?>

<h1>Contact</h1>
<form method="post">
    <p>
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required minlength="2" maxlength="255"
            <?php
            if (sizeof($errorMessage) != 0) {
                if (!isset($errorMessage["nom"])) echo "value='" . htmlspecialchars($_POST["nom"]) . "'";
                else echo "aria-invalid='true'";
            }
            ?>>
        <?= $errorMessage["nom"] ?? null ?>
    </p>
    <p>
        <label for="prenom">Prénom :</label>
        <input type="text" id="prenom" name="prenom" minlength="2" maxlength="255"
            <?php
            if (sizeof($errorMessage) != 0) {
                if (!isset($errorMessage["prenom"])) echo "value='" . htmlspecialchars($_POST["prenom"]) . "'";
                else echo "aria-invalid='true'";
            }
            ?>>
        <?= $errorMessage["prenom"] ?? null ?>
    </p>
    <p>
        <label for="mail">Email :</label>
        <input type="email" name="mail" id="mail" required
            <?php
            if (sizeof($errorMessage) != 0) {
                if (!isset($errorMessage["mail"])) echo "value='" . htmlspecialchars($_POST["mail"]) . "'";
                else echo "aria-invalid='true'";
            }
            ?>>
        <?= $errorMessage["mail"] ?? null ?>
    </p>
    <p>
        <label for="message">Message :</label>
        <?= $errorMessage["message"] ?? null ?>
    </p>
    <p>
        <textArea id="message" required name="message" minlength="10" maxlength="3000" <?= $errorMessage["message"] ? "aria-invalid='true'" : null ?>>
            <?php
            if (sizeof($errorMessage) != 0) {
                if (!isset($errorMessage["message"])) echo  htmlspecialchars($_POST["message"]);
            }
            ?></textArea>
    </p>

    <input type="submit" value="valider">
    <p><?= $statut ?? null ?></p>
</form>

<?php require_once __DIR__ . DIRECTORY_SEPARATOR . 'footer.php'; ?>