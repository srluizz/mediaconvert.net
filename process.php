<?php
ob_start();
ini_set('memory_limit', '512M'); // Aumentado para lidar com TIFFs pesados
include_once 'includes/i18n.php';

header('Content-Type: application/json');
header('Cache-Control: no-cache, must-revalidate');

$method = strtoupper($_SERVER['REQUEST_METHOD']);
if ($method === 'OPTIONS') exit;

if ($method !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Metodo invalido.']);
    exit;
}

if (!isset($_FILES['image'])) {
    echo json_encode(['success' => false, 'error' => 'Nenhuma imagem recebida.']);
    exit;
}

$targetFormat = strtolower($_POST['format'] ?? 'jpg');
$file = $_FILES['image'];
$targetDir = __DIR__ . '/uploads/';

if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

if ($file['error'] !== UPLOAD_ERR_OK) {
    echo json_encode(['success' => false, 'error' => 'Erro de upload: ' . $file['error']]);
    exit;
}

$sourcePath = $file['tmp_name'];

try {
    if (!extension_loaded('imagick')) {
        throw new Exception('Extensao Imagick nao encontrada.');
    }

    $image = new Imagick($sourcePath);

    // 1. Tratamento de Cores e Transparência
    if (in_array($targetFormat, ['jpg', 'jpeg', 'bmp'])) {
        $image->setImageBackgroundColor('white');
        $image = $image->flattenImages(); 
    }


    if ($targetFormat === 'ico') {

        $image->resizeImage(48, 48, Imagick::FILTER_LANCZOS, 1);
    }

    $image->setImageFormat($targetFormat);


    if (in_array($targetFormat, ['jpg', 'jpeg', 'webp'])) {
        $image->setImageCompressionQuality(85);
    }

    $newFileName = 'mediaconvert_' . time() . '_' . bin2hex(random_bytes(4)) . '.' . $targetFormat;
    $outputPath = $targetDir . $newFileName;

    $success = $image->writeImage($outputPath);

    $image->clear();
    $image->destroy();

    if ($success) {
        ob_clean();
        echo json_encode([
            'success' => true,
            'downloadUrl' => '/uploads/' . $newFileName, 
            'fileName' => $newFileName
        ]);
    } else {
        throw new Exception('Falha ao gravar arquivo.');
    }

} catch (Exception $e) {
    ob_clean();
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}