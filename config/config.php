<?php
define('DS', DIRECTORY_SEPARATOR);
define('ROOT', dirname(__DIR__,1) . DS);
define('CONTROLLERS',ROOT.DS.'app'.DS.'controllers'.DS);
define('MODELS',ROOT.DS.'app'.DS.'models'.DS);
define('VIEWS',ROOT.DS.'app'.DS.'views'.DS);
define('TEMPLATE',VIEWS.'template'.DS);
define('CORE',ROOT.DS.'core'.DS);
define('DEV_MODE',true);

function obtenirConfigBdd(): array
{
    return [
        'serveur'     => 'localhost',
        'bdd'         => 'bdd_projet_web',
        'utilisateur' => 'root',
        'mdp'         => ''
    ];
}