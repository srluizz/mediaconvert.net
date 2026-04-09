<?php
$targetDir = __DIR__ . '/uploads/';
$expireTime = 1800; 

if (is_dir($targetDir)) {
    $files = glob($targetDir . "*"); 
    foreach ($files as $file) {
        if (is_file($file) && (time() - filemtime($file) > $expireTime)) {
            unlink($file); 
        }
    }
}