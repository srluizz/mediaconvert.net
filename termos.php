<?php 
    include_once 'includes/i18n.php';
    $pageTitle = __('termos.title') . " | MediaConvert.net";
    include 'components/header.php'; 
?>

<main class="flex-grow bg-slate-50 py-12">
    <div class="container mx-auto px-4 max-w-4xl">
        <div class="bg-white rounded-3xl shadow-sm border border-slate-100 p-8 md:p-12 prose prose-slate max-w-none">
            <h1 class="text-3xl font-black text-slate-900 mb-6"><?php echo __('termos.title'); ?></h1>
            <div class="text-slate-600 leading-relaxed space-y-6">
                <?php echo __('termos.content'); ?>
            </div>
        </div>
    </div>
</main>

<?php include 'components/footer.php'; ?>