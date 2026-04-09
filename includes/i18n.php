<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$lang = $_GET['lang'] ?? $_SESSION['lang'] ?? 'pt';

$allowedLangs = ['pt', 'en', 'es', 'de', 'ar'];
if (!in_array($lang, $allowedLangs)) {
    $lang = 'pt';
}

$_SESSION['lang'] = $lang;

$langFile = __DIR__ . "/../locales/{$lang}.json";

if (file_exists($langFile)) {
    $jsonContent = file_get_contents($langFile);
    $translations = json_decode($jsonContent, true);
} else {
    $fallbackFile = __DIR__ . "/../locales/pt.json";
    $translations = file_exists($fallbackFile) ? json_decode(file_get_contents($fallbackFile), true) : [];
}

function __($key) {
    global $translations;
    if (!$translations) return $key;

    $keys = explode('.', $key);
    $result = $translations;

    foreach ($keys as $k) {
        if (isset($result[$k])) {
            $result = $result[$k];
        } else {
            return $key;
        }
    }
    return $result;
}

/**
 * Gerador de URL Amigável
 * Mantém o idioma na estrutura da URL de forma limpa.
 */
function url($path = '') {
    global $lang;
    
    // Remove barras do início para evitar duplicidade
    $path = ltrim($path, '/');
    
    // Se for a home, retorna /pt/ ou /en/
    if ($path === 'index' || empty($path)) {
        return "/" . $lang . "/";
    }
    
    // Se o path começar com # ou ?, não adiciona a barra extra entre o idioma e o path
    // Ex: /pt/#formatos em vez de /pt/ #formatos
    $separator = (str_starts_with($path, '#') || str_starts_with($path, '?')) ? "" : "/";
    
    return "/" . $lang . $separator . $path;
}