<?php

$app = require __DIR__ . '/app.php';

$storagePath = $_ENV['APP_BASE_PATH'] ?? __DIR__ . '/../storage';

$isVercel = isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL']) || getenv('VERCEL') !== false || getenv('VERCEL_URL') !== false;
if ($isVercel) {
    $storagePath = '/tmp/storage';
    $dirs = [
        '/tmp/storage',
        '/tmp/storage/app',
        '/tmp/storage/app/public',
        '/tmp/storage/framework',
        '/tmp/storage/framework/cache',
        '/tmp/storage/framework/cache/data',
        '/tmp/storage/framework/sessions',
        '/tmp/storage/framework/views',
        '/tmp/storage/framework/testing',
        '/tmp/storage/logs',
    ];
    foreach ($dirs as $dir) {
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
    }
    $modulesFile = '/tmp/storage/modules_statuses.json';
    if (!file_exists($modulesFile) && file_exists(__DIR__ . '/../modules_statuses.json')) {
        @copy(__DIR__ . '/../modules_statuses.json', $modulesFile);
    }
    $_ENV['MODULES_STATUSES_PATH'] = $modulesFile;
    $_SERVER['MODULES_STATUSES_PATH'] = $modulesFile;
    putenv("MODULES_STATUSES_PATH={$modulesFile}");

    $bootstrapPath = '/tmp/bootstrap';
    if (!is_dir($bootstrapPath . '/cache')) {
        mkdir($bootstrapPath . '/cache', 0755, true);
        if (is_dir(__DIR__ . '/cache')) {
            foreach (glob(__DIR__ . '/cache/*') as $file) {
                if (is_file($file)) {
                    @copy($file, $bootstrapPath . '/cache/' . basename($file));
                }
            }
        }
    }
    $app->useBootstrapPath($bootstrapPath);
}

$app->useStoragePath($storagePath);

return $app;
