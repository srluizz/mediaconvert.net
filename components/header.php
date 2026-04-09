<?php include_once dirname(__DIR__) . '/includes/i18n.php'; ?>
<!DOCTYPE html>
<html lang="<?php echo $lang; ?>" <?php echo ($lang == 'ar' ? 'dir="rtl"' : ''); ?>>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $pageTitle ?? 'MediaConvert | Conversor de Imagens Grátis'; ?></title>
    <meta name="description" content="<?php echo $pageDesc ?? 'Converta imagens online gratuitamente.'; ?>">
    <link rel="shortcut icon" href="favicon.ico" type="image/x-icon">
    
    <?php 
        $currentRelativePath = ltrim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/');
        $parts = explode('/', $currentRelativePath);
        
        if (in_array($parts[0], ['pt', 'en', 'es', 'de', 'ar'])) array_shift($parts);
        $pagePath = implode('/', $parts);
        
        $baseUrl = "https://mediaconvert.net"; 
        foreach (['pt', 'en', 'es', 'de', 'ar'] as $l): 
    ?>
    <link rel="alternate" hreflang="<?php echo $l; ?>" href="<?php echo "$baseUrl/$l/$pagePath"; ?>" />
    <?php endforeach; ?>
    <link rel="alternate" hreflang="x-default" href="<?php echo "$baseUrl/en/$pagePath"; ?>" />

    <base href="/">

    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; }
        .loading-bar { transition: width 0.4s ease; }
        html { scroll-behavior: smooth; }
    </style>
</head>
<body class="bg-slate-50 text-slate-900 flex flex-col min-h-screen">

<header class="bg-white border-b border-slate-100 sticky top-0 z-50">
    <nav class="container mx-auto px-4 h-16 flex items-center justify-between">
        
        <a href="<?php echo url(); ?>" class="text-2xl font-extrabold text-blue-600 tracking-tight">
            MediaConvert<span class="text-slate-400">.net</span>
        </a>

        <ul class="hidden md:flex items-center space-x-8 text-sm font-semibold text-slate-600">
            <li><a href="<?php echo url(); ?>" class="hover:text-blue-600 transition"><?php echo __('header.home'); ?></a></li>
            <li><a href="<?php echo url('#como-funciona'); ?>" class="hover:text-blue-600 transition"><?php echo __('header.how_it_works'); ?></a></li>
            <li><a href="<?php echo url('#formatos'); ?>" class="hover:text-blue-600 transition"><?php echo __('header.formats'); ?></a></li>
        </ul>

        <div class="flex items-center space-x-4">
            <select 
                onchange="let p = window.location.pathname.split('/').filter(Boolean); p[0] = this.value; window.location.href = '/' + p.join('/') + window.location.search;" 
                class="bg-slate-100 border-none text-xs rounded-lg px-2 py-1 focus:ring-2 focus:ring-blue-500 cursor-pointer"
            >
                <option value="pt" <?php echo $lang == 'pt' ? 'selected' : ''; ?>>PT</option>
                <option value="en" <?php echo $lang == 'en' ? 'selected' : ''; ?>>EN</option>
                <option value="es" <?php echo $lang == 'es' ? 'selected' : ''; ?>>ES</option>
                <option value="de" <?php echo $lang == 'de' ? 'selected' : ''; ?>>DE</option>
                <option value="ar" <?php echo $lang == 'ar' ? 'selected' : ''; ?>>AR</option>
            </select>

            <a href="<?php echo url('converter'); ?>" class="bg-blue-600 text-white px-4 py-2 rounded-lg text-sm font-bold hover:bg-blue-700 transition">
                <?php echo __('header.get_started'); ?>
            </a>
        </div>
    </nav>
</header>