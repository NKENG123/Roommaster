<?php

// Crée le .env à partir des variables d'environnement Vercel
$envPath = __DIR__ . '/../.env';

if (!file_exists($envPath)) {
    $envContent = '';
    foreach ($_ENV as $key => $value) {
        $envContent .= $key . '=' . $value . "\n";
    }
    file_put_contents($envPath, $envContent);
}

require __DIR__ . '/../public/index.php';