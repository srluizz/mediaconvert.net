<?php
ob_start();
ini_set('memory_limit', '512M'); 
include_once __DIR__ . '/../includes/i18n.php';

header('Content-Type: application/json');
header('Cache-Control: no-cache, must-revalidate');

$method = strtoupper($_SERVER['REQUEST_METHOD']);
if ($method === 'OPTIONS') exit;

if ($method !== 'POST') {
    echo json_encode(['success' => false, 'error' => 'Metodo invalido.']);
    exit;
}

// Verifica se recebeu o array de imagens
if (!isset($_FILES['images'])) {
    echo json_encode(['success' => false, 'error' => 'Nenhuma imagem recebida.']);
    exit;
}

$targetFormat = strtolower($_POST['format'] ?? 'jpg');
$targetDir = dirname(__DIR__) . '/uploads/';
if (!is_dir($targetDir)) mkdir($targetDir, 0777, true);

try {
    if (!extension_loaded('imagick')) {
        throw new Exception('Extensao Imagick nao encontrada.');
    }

    $results = [];
    $files = $_FILES['images'];

    // No PHP, quando enviamos múltiplos arquivos com o mesmo nome[], 
    // a estrutura do array $_FILES muda. Precisamos iterar assim:
    for ($i = 0; $i < count($files['name']); $i++) {
        
        if ($files['error'][$i] !== UPLOAD_ERR_OK) continue;

        $sourcePath = $files['tmp_name'][$i];
        $originalName = $files['name'][$i];

        $image = new Imagick($sourcePath);

        // 1. Tratamento de Cores e Transparência
        if (in_array($targetFormat, ['jpg', 'jpeg', 'bmp'])) {
            $image->setImageBackgroundColor('white');
            $image = $image->mergeImageLayers(Imagick::LAYERMETHOD_FLATTEN); 
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

        if ($image->writeImage($outputPath)) {
            $results[] = [
                'url' => '/uploads/' . $newFileName,
                'originalName' => pathinfo($originalName, PATHINFO_FILENAME) . '.' . $targetFormat
            ];
        }

        $image->clear();
        $image->destroy();
    }

    if (count($results) > 0) {
        ob_clean();
        echo json_encode([
            'success' => true,
            'files' => $results
        ]);
    } else {
        throw new Exception('Nenhum arquivo pôde ser processado.');
    }

} catch (Exception $e) {
    ob_clean();
    echo json_encode(['success' => false, 'error' => $e->getMessage()]);
}