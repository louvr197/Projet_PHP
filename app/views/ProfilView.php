<?php

require_once TEMPLATE . 'header.php';
?>
<h1>Profil</h1>

<form method="post" action="/deconnexion">
    <p>Pseudo : <?= htmlspecialchars($utilisateur['uti_pseudo']) ?></p>
    <p>Email : <?= htmlspecialchars($utilisateur['uti_email']) ?></p>
    <button type="submit">Se déconnecter</button>
</form>
<?php require_once TEMPLATE . 'footer.php'; ?>