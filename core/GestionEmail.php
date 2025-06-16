<?php
function mailContact()
{

    // 1. Expéditeur du courriel.
    $expediteur = htmlspecialchars($_POST["prenom"]) . " " . htmlspecialchars($_POST["nom"]) . "<" . htmlspecialchars($_POST["mail"]) . ">";

    // 2. Destinataire du courriel.
    $destinataire = "Louis <louis.vanrent@gmail.com>";

    // 3. Sujet du courriel.
    $sujet = "Projet Framework - Formulaire de contact";

    // Encodage du sujet en Quoted-Printable.
    $sujet = quoted_printable_encode($sujet);

    // Remplacement des espaces par des underscores (recommandé en Q-Encoding).
    $sujet = str_replace(' ', '_', $sujet);

    // Encapsulation selon la syntaxe MIME.
    $sujet = "=?UTF-8?Q?" . $sujet . "?=";

    // 4. Configurer les en-têtes.
    $entetes = [
        "From" => $expediteur,
        "MIME-Version" => "1.0",
        "Content-Type" => "text/html; charset=\"UTF-8\"",
        "Content-Transfer-Encoding" => "quoted-printable"
    ];

    // 5. Corps du message au format HTML.
    ob_start();
?>
    <html>

    <body>
        <?= $_POST["message"] ?>
    </body>

    </html>
<?php
    $message = ob_get_clean();

    // Encodage en quoted-printable.
    // Limite automatiquement les lignes à 76 caractères, encode les caractères spéciaux
    // et prévient toute mauvaise interprétation de fin de message par les serveurs SMTP.
    // Il ne faut donc plus utiliser ni "wordwrap()" pour limiter la longueur des lignes,
    // ni "str_replace()" pour les points.
    $message = quoted_printable_encode($message);

    // 6. Tentative d'envoi du courriel :
    if (DEBUG) {
        echo "<pre>";
        echo htmlspecialchars($destinataire);
        print_r($entetes);
        echo "</pre>";
    }

    return mail($destinataire, $sujet, $message, $entetes);

}
