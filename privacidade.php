<?php 
    include_once 'includes/i18n.php';
    
    $pageTitle = __('privacidade.title') . " | MediaConvert.net";
    $pageDesc = "Saiba como o MediaConvert.net protege suas imagens e garante sua privacidade durante a conversão.";
    
    include 'components/header.php'; 
?>

<main class="flex-grow bg-slate-50 py-12">
    <div class="container mx-auto px-4 max-w-4xl">
        
        <nav class="flex mb-8 text-sm font-medium text-slate-400" aria-label="Breadcrumb">
            <ol class="flex items-center space-x-2">
                <li><a href="<?php echo url(); ?>" class="hover:text-blue-600 transition"><?php echo __('header.home'); ?></a></li>
                <li class="flex items-center space-x-2">
                    <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"/></svg>
                    <span class="text-slate-600"><?php echo __('privacidade.title'); ?></span>
                </li>
            </ol>
        </nav>

        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8 md:p-12">
            <article class="prose prose-slate max-w-none">
                <h1 class="text-3xl md:text-4xl font-black text-slate-900 mb-8">
                    <?php echo __('privacidade.title'); ?>
                </h1>
                
                <div class="text-slate-600 leading-relaxed space-y-8">
                    <?php echo __('privacidade.content'); ?>
                </div>

                <div class="mt-12 p-6 bg-blue-50 rounded-2xl border border-blue-100 flex items-center space-x-4">
                    <div class="bg-blue-600 text-white p-3 rounded-full">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                        </svg>
                    </div>
                    <div>
                        <p class="text-sm font-bold text-blue-900">Privacidade em Primeiro Lugar</p>
                        <p class="text-xs text-blue-700">Seus arquivos nunca são visualizados por humanos e são deletados automaticamente.</p>
                    </div>
                </div>
            </article>
        </div>
    </div>
</main>

<?php include 'components/footer.php'; ?>