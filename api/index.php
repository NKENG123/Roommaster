<?php

try {
    // Charger les variables d'environnement Vercel
    foreach (getenv() as $key => $value) {
        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
    }

    // Créer les dossiers nécessaires dans /tmp
    $dirs = [
        '/tmp/.env',
        '/tmp/storage/logs',
        '/tmp/storage/framework/sessions',
        '/tmp/storage/framework/views',
        '/tmp/storage/framework/cache/data',
        '/tmp/bootstrap/cache',
    ];

    foreach ($dirs as $dir) {
        if (str_ends_with($dir, '.env')) {
            if (!file_exists($dir)) file_put_contents($dir, '');
        } else {
            if (!is_dir($dir)) mkdir($dir, 0777, true);
        }
    }

    define('LARAVEL_START', microtime(true));
    require __DIR__ . '/../vendor/autoload.php';

    $app = require_once __DIR__ . '/../bootstrap/app.php';

    // Rediriger vers /tmp
    $app->useEnvironmentPath('/tmp');
    $app->useStoragePath('/tmp/storage');
    $app->bootstrapPath('/tmp/bootstrap');

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