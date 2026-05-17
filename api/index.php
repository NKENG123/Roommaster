<?php

// Test basique d'abord
echo "PHP fonctionne !<br>";
echo "PHP version: " . PHP_VERSION . "<br>";

// Vérifie si vendor existe
if (!file_exists(__DIR__ . '/../vendor/autoload.php')) {
    die("<b style='color:red'>ERREUR: vendor/autoload.php manquant - composer install n'a pas tourné</b>");
}
echo "vendor OK<br>";

// Vérifie .env
if (!file_exists(__DIR__ . '/../.env')) {
    die("<b style='color:orange'>ATTENTION: fichier .env manquant</b>");
}
echo ".env OK<br>";

// Lance Laravel
require __DIR__ . '/../public/index.php';