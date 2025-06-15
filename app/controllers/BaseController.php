<?php

function creerNavItem($segmentUrl,$nomPage):string {
    $estPageActuelle = $_SERVER["REQUEST_URI"] === $segmentUrl;
    $classCss = $estPageActuelle?'active':'';
    ob_start();
    ?>
    <li>
        <a href=<?=  $segmentUrl ?> class="<?= $classCss ?>">
            <?=$nomPage?>
        </a>
    </li>
    <?php return ob_get_clean();
}

$navItems = creerNavItem('/','Acceuil') . creerNavItem('/contact','Contact');