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
$navItems = '';
if(est_connecte()){
$navItems = creerNavItem('/','Acceuil') . creerNavItem('/contact','Contact').creerNavItem('/profil','Profil').creerNavItem('/deconnexion','Deconnexion');
}
else {
$navItems = creerNavItem('/','Acceuil') . creerNavItem('/contact','Contact').creerNavItem('/inscription','Inscription').creerNavItem('/connexion','Connexion');
}