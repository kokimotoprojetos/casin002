<?php

echo "PHP OK\n";

if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    echo "Autoload OK\n";
    require __DIR__ . '/../vendor/autoload.php';
    echo "Autoload loaded OK\n";
} else {
    echo "Autoload not found at: " . __DIR__ . '/../vendor/autoload.php' . "\n";
}

echo "Extensions: ";
echo "intl=" . (extension_loaded('intl') ? 'yes' : 'no') . ", ";
echo "pdo_mysql=" . (extension_loaded('pdo_mysql') ? 'yes' : 'no') . ", ";
echo "curl=" . (extension_loaded('curl') ? 'yes' : 'no') . "\n";