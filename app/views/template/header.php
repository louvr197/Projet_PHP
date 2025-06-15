<!DOCTYPE html>
<html lang="fr">

<head>
    <?php
    require_once __DIR__ . DIRECTORY_SEPARATOR . "navPrincipale.php";
    ?>
    <link rel="stylesheet" type="text/css" href="./assets/css/styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitre  ?></title>
    <meta name="description" content="<?= $metaDescription  ?? 'description par défault' ?>">

</head>

<body>
    <header>
        <nav>
            <ul>
                <?= $navItems ?>
            </ul>
        </nav>
    </header>
    <main>