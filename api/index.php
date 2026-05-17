<?php

try {
    // Charger toutes les variables d'environnement Vercel
    foreach (getenv() as $key => $value) {
        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
    }

    // Créer un faux .env vide dans /tmp
    $envFile = '/tmp/.env';
    if (!file_exists($envFile)) {
        file_put_contents($envFile, '');
    }

    define('LARAVEL_START', microtime(true));
    require __DIR__ . '/../vendor/autoload.php';

    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $app->useEnvironmentPath('/tmp');

    $kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
    $response = $kernel->handle(
        $request = Illuminate\Http\Request::capture()
    )->send();

    $kernel->terminate($request, $response);

} catch (\Throwable $e) {
    echo "<pre style='color:red;font-size:14px'>";
    echo "<b>ERREUR:</b> " . $e->getMessage() . "\n\n";
    echo "<b>Fichier:</b> " . $e->getFile() . ":" . $e->getLine() . "\n\n";
    echo "<b>Stack:</b>\n" . $e->getTraceAsString();
    echo "</pre>";
}