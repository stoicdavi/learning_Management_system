<?php
require_once __DIR__ . '/vendor/autoload.php';

use Dotenv\Dotenv;

// Initialize Dotenv and load environment variables
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();
