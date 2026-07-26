<?php

$app = require __DIR__ . '/app.php';

$storagePath = $_ENV['APP_BASE_PATH'] ?? __DIR__ . '/../storage';

$isVercel = isset($_ENV['VERCEL']) || isset($_SERVER['VERCEL']);
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
}

$app->useStoragePath($storagePath);

return $app;
