<?php 
    include_once 'includes/i18n.php';

    $pageTitle = "MediaConvert | " . __('hero.title');
    $pageDesc = __('hero.subtitle');
    
    include 'components/header.php'; 
?>

<main class="flex-grow">
    
    <section class="relative bg-white pt-20 pb-16 overflow-hidden">
        <div class="container mx-auto px-4 relative z-10">
            <div class="max-w-4xl mx-auto text-center">
                <span class="inline-block py-1 px-3 rounded-full bg-blue-50 text-blue-600 text-xs font-bold uppercase tracking-wider mb-4">
                    <?php echo __('hero.badge'); ?>
                </span>
                <h1 class="text-5xl md:text-7xl font-black text-slate-900 mb-6 tracking-tight">
                    <?php echo __('hero.title'); ?> <br>
                    <span class="text-blue-600"><?php echo __('hero.title_highlight'); ?></span>
                </h1>
                <p class="text-xl text-slate-600 mb-10 max-w-2xl mx-auto leading-relaxed">
                    <?php echo __('hero.subtitle'); ?>
                </p>
                
                <div class="flex flex-col sm:flex-row justify-center gap-4">
                    <a href="<?php echo url('converter'); ?>" class="bg-blue-600 text-white px-10 py-5 rounded-2xl font-bold text-lg hover:bg-blue-700 shadow-2xl shadow-blue-200 transition transform hover:-translate-y-1">
                        <?php echo __('hero.cta_main'); ?>
                    </a>
                    <a href="<?php echo url('#formatos'); ?>" class="bg-slate-100 text-slate-700 px-10 py-5 rounded-2xl font-bold text-lg hover:bg-slate-200 transition">
                        <?php echo __('hero.cta_sec'); ?>
                    </a>
                </div>
            </div>
        </div>
        
        <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-full -z-0 opacity-10 pointer-events-none">
            <div class="absolute top-10 left-10 w-72 h-72 bg-blue-400 rounded-full mix-blend-multiply filter blur-3xl animate-blob"></div>
            <div class="absolute top-0 right-10 w-72 h-72 bg-purple-400 rounded-full mix-blend-multiply filter blur-3xl animate-blob animation-delay-2000"></div>
        </div>
    </section>

    <section id="formatos" class="py-20 bg-slate-50 border-y border-slate-100">
        <div class="container mx-auto px-4 text-center">
            <h2 class="text-3xl font-extrabold mb-12 text-slate-900 tracking-tight">
                <?php echo __('seo.features_title'); ?>
            </h2>
            
            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-5xl mx-auto">
                <a href="<?php echo url('converter?to=jpg'); ?>" class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:border-blue-500 hover:shadow-md transition group">
                    <div class="font-bold text-slate-800 group-hover:text-blue-600 transition uppercase">PNG para JPG</div>
                    <p class="text-xs text-slate-400 mt-1 uppercase font-semibold">Rápido & Leve</p>
                </a>
                <a href="<?php echo url('converter?to=png'); ?>" class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:border-blue-500 hover:shadow-md transition group">
                    <div class="font-bold text-slate-800 group-hover:text-blue-600 transition uppercase">JPG para PNG</div>
                    <p class="text-xs text-slate-400 mt-1 uppercase font-semibold">Com Transparência</p>
                </a>
                <a href="<?php echo url('converter?to=jpg'); ?>" class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:border-blue-500 hover:shadow-md transition group">
                    <div class="font-bold text-slate-800 group-hover:text-blue-600 transition uppercase">WEBP para JPG</div>
                    <p class="text-xs text-slate-400 mt-1 uppercase font-semibold">Otimização Web</p>
                </a>
                <a href="<?php echo url('converter?to=png'); ?>" class="bg-white p-6 rounded-2xl shadow-sm border border-slate-200 hover:border-blue-500 hover:shadow-md transition group">
                    <div class="font-bold text-slate-800 group-hover:text-blue-600 transition uppercase">TIFF para PNG</div>
                    <p class="text-xs text-slate-400 mt-1 uppercase font-semibold">Alta Resolução</p>
                </a>
            </div>
        </div>
    </section>

    <section class="py-24 bg-white">
        <div class="container mx-auto px-4 max-w-4xl">
            <div class="prose prose-slate max-w-none">
                <h2 class="text-4xl font-extrabold text-slate-900 mb-8 text-center italic">
                    Conversão Profissional
                </h2>
                
                <div class="space-y-12">
                    <div class="text-center md:text-left">
                        <h3 class="text-2xl font-bold text-blue-600"><?php echo __('seo.features_title'); ?></h3>
                        <p class="text-slate-600 text-lg leading-relaxed">
                            O <strong>MediaConvert.net</strong> nasceu da necessidade de uma ferramenta rápida que não sacrificasse a privacidade do usuário.
                        </p>
                    </div>

                    <div class="grid md:grid-cols-2 gap-8">
                        <div class="bg-blue-50 p-6 rounded-2xl border border-blue-100">
                            <h4 class="font-bold text-slate-800 mb-2"><?php echo __('seo.feature_1_title'); ?></h4>
                            <p class="text-sm text-slate-600"><?php echo __('seo.feature_1_text'); ?></p>
                        </div>
                        <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100">
                            <h4 class="font-bold text-slate-800 mb-2"><?php echo __('seo.feature_2_title'); ?></h4>
                            <p class="text-sm text-slate-600"><?php echo __('seo.feature_2_text'); ?></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="py-20 bg-slate-50">
        <div class="container mx-auto px-4 max-w-3xl">
            <h2 class="text-3xl font-bold mb-10 text-center"><?php echo __('seo.faq_title'); ?></h2>
            <div class="space-y-6">
                <details class="bg-white p-6 rounded-2xl shadow-sm cursor-pointer group border border-slate-200 transition-all hover:border-blue-300">
                    <summary class="font-bold text-slate-800 group-hover:text-blue-600 transition list-none flex justify-between items-center outline-none">
                        <?php echo __('seo.faq_1_q'); ?>
                        <span class="text-blue-600 text-xl group-open:rotate-45 transition-transform">+</span>
                    </summary>
                    <p class="mt-4 text-slate-600 text-sm leading-relaxed"><?php echo __('seo.faq_1_a'); ?></p>
                </details>
                <details class="bg-white p-6 rounded-2xl shadow-sm cursor-pointer group border border-slate-200 transition-all hover:border-blue-300">
                    <summary class="font-bold text-slate-800 group-hover:text-blue-600 transition list-none flex justify-between items-center outline-none">
                        <?php echo __('seo.faq_2_q'); ?>
                        <span class="text-blue-600 text-xl group-open:rotate-45 transition-transform">+</span>
                    </summary>
                    <p class="mt-4 text-slate-600 text-sm leading-relaxed"><?php echo __('seo.faq_2_a'); ?></p>
                </details>
            </div>
        </div>
    </section>

</main>

<?php include 'components/footer.php'; ?>