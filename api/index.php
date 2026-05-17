<?php

// Charger toutes les variables d'environnement Vercel
foreach (getenv() as $key => $value) {
    $_ENV[$key] = $value;
    $_SERVER[$key] = $value;
}

// Créer un faux .env vide dans /tmp (seul dossier accessible en écriture)
$envFile = '/tmp/.env';
if (!file_exists($envFile)) {
    file_put_contents($envFile, '');
}

// Dire à Laravel d'utiliser /tmp comme emplacement du .env
$_ENV['APP_BASE_PATH'] = dirname(__DIR__);

// Charger Laravel
define('LARAVEL_START', microtime(true));
require __DIR__ . '/../vendor/autoload.php';

$app = require_once __DIR__ . '/../bootstrap/app.php';

// Forcer le chargement depuis /tmp/.env
$app->useEnvironmentPath('/tmp');

$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$response = $kernel->handle(
    $request = Illuminate\Http\Request::capture()
)->send();

$kernel->terminate($request, $response);