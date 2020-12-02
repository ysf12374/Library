<?php

use Symfony\Component\Dotenv\Dotenv;

require dirname(__DIR__).'/vendor/autoload.php';

if (file_exists(dirname(__DIR__).'/config/bootstrap.php')) {
    require dirname(__DIR__).'/config/bootstrap.php';
} elseif (method_exists(Dotenv::class, 'bootEnv')) {
    (new Dotenv())->bootEnv(dirname(__DIR__).'/.env');
}

# Clear database before all tests
echo "Environment is " . $_SERVER['APP_ENV'] . "\n";
echo "Clearing cache...\n";
exec('APP_ENV=test ./bin/console cache:clear');
echo "Clearing database...\n";
exec('APP_ENV=test ./bin/reset-db');