<?php
$request = $_SERVER['REQUEST_URI'];
$path = parse_url($request, PHP_URL_PATH);
$parts = explode('/', trim($path, '/'));
$allowedLangs = ['pt', 'en', 'es', 'de', 'ar'];

if (file_exists(__DIR__ . $path) && !is_dir(__DIR__ . $path)) {
    return false; 
}

if ($path === '/process.php') {
    include __DIR__ . '/api/process.php';
    exit;
}

if (!empty($parts[0]) && in_array($parts[0], $allowedLangs)) {
    $_GET['lang'] = $parts[0];
    $page = (isset($parts[1]) && !empty($parts[1])) ? $parts[1] : 'index';
    
    if (file_exists(__DIR__ . "/pages/" . $page . ".php")) {
        include __DIR__ . "/pages/" . $page . ".php";
        exit;
    }
}

if ($path == '/' || empty($parts[0])) {
    header("Location: /pt/");
    exit;
}

$potentialPage = $parts[0] . ".php";
if (file_exists(__DIR__ . "/pages/" . $potentialPage)) {
    $_GET['lang'] = 'pt';
    include __DIR__ . "/pages/" . $potentialPage;
    exit;
}

$_GET['lang'] = 'pt';
include __DIR__ . "/pages/index.php";