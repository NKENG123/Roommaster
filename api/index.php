<?php

// Debug: afficher les vars disponibles
$appKey = getenv('APP_KEY');
$vercel = getenv('VERCEL');

echo "APP_KEY présent: " . ($appKey ? "OUI - " . substr($appKey, 0, 10) . "..." : "NON - MANQUANT") . "<br>";
echo "VERCEL env: " . ($vercel ?: "non défini") . "<br>";
echo "Total vars: " . count(getenv()) . "<br>";

// Lister toutes les vars disponibles (sans les valeurs sensibles)
foreach (getenv() as $key => $value) {
    echo $key . "<br>";
}