<?php

require_once TEMPLATE . 'header.php';

?>

<h1>Contact</h1>
<form class="contactForm" method="post">

    <?php if ($_SERVER['REQUEST_METHOD'] === "POST") echo '<p class="status">' . htmlspecialchars($statut) . '</p>';    ?>
    <label for="nom">Nom :</label>
    <p class="errorMessage"><?= $errorMessage["nom"] ?? null ?></p>
    <input type="text" id="nom" name="nom" required minlength="2" maxlength="255"
        <?php
        if (sizeof($errorMessage) != 0) {
            if (!isset($errorMessage["nom"])) echo "value='" . htmlspecialchars($_POST["nom"]) . "'";
            else echo "aria-invalid='true'";
        }
        ?>>

    <label for="prenom">Prénom :</label>
    <p class="errorMessage"><?= $errorMessage["prenom"] ?? null ?></p>
    <input type="text" id="prenom" name="prenom" minlength="2" maxlength="255"
        <?php
        if (sizeof($errorMessage) != 0) {
            if (!isset($errorMessage["prenom"])) echo "value='" . htmlspecialchars($_POST["prenom"]) . "'";
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
    <label for="message">Message :</label>
    <p class="errorMessage"><?= $errorMessage["message"] ?? null ?></p>

    <textArea id="message" required name="message" minlength="10" maxlength="3000" <?= array_key_exists("message", $errorMessage) ? "aria-invalid='true'" : null ?>><?php
                                                                                                                                                                    if (sizeof($errorMessage) != 0 && !isset($errorMessage["message"]))
                                                                                                                                                                        echo  htmlspecialchars($_POST["message"]);
                                                                                                                                                                    ?></textArea>

    <input type="submit" value="valider">

</form>

<?php require_once TEMPLATE . 'footer.php'; ?>