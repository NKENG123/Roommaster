<?php

try {
    // 1. Charger les vars Vercel EN PREMIER
    foreach (getenv() as $key => $value) {
        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
        putenv("$key=$value");
    }

    // 2. Créer les dossiers dans /tmp
    $dirs = [
        '/tmp/storage/logs',
        '/tmp/storage/framework/sessions',
        '/tmp/storage/framework/views',
        '/tmp/storage/framework/cache/data',
        '/tmp/bootstrap/cache',
    ];
    foreach ($dirs as $dir) {
        if (!is_dir($dir)) mkdir($dir, 0777, true);
    }

    // 3. Créer un vrai .env dans /tmp avec toutes les variables
    $envContent = '';
    foreach ($_ENV as $key => $value) {
        $value = str_replace('"', '\\"', $value);
        $envContent .= $key . '="' . $value . '"' . "\n";
    }
    file_put_contents('/tmp/.env', $envContent);

    // 4. Lancer Laravel
    define('LARAVEL_START', microtime(true));
    require __DIR__ . '/../vendor/autoload.php';

    $app = require_once __DIR__ . '/../bootstrap/app.php';
    $app->useEnvironmentPath('/tmp');
    $app->useStoragePath('/tmp/storage');

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