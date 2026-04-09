<footer class="bg-slate-900 text-slate-400 py-12 mt-auto">
    <div class="container mx-auto px-4">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-12 mb-12">
            <div class="md:col-span-2">
                <h2 class="text-white text-lg font-bold mb-4">MediaConvert<span class="text-blue-500">.net</span></h2>
                <p class="text-sm leading-relaxed max-w-sm">
                    <?php echo __('footer.description'); ?>
                </p>
            </div>

            <div>
                <h3 class="text-white font-bold mb-4 text-sm uppercase tracking-widest"><?php echo __('footer.tools_title'); ?></h3>
                <ul class="text-sm space-y-2">
                    <li><a href="<?php echo url('converter?to=png'); ?>" class="hover:text-white transition">JPG para PNG</a></li>
                    <li><a href="<?php echo url('converter?to=jpg'); ?>" class="hover:text-white transition">PNG para JPG</a></li>
                    <li><a href="<?php echo url('converter?to=webp'); ?>" class="hover:text-white transition">TIFF para WEBP</a></li>
                </ul>
            </div>

            <div>
                <h3 class="text-white font-bold mb-4 text-sm uppercase tracking-widest"><?php echo __('footer.legal_title'); ?></h3>
                <ul class="text-sm space-y-2">
                    <li><a href="<?php echo url('termos'); ?>" class="hover:text-white transition"><?php echo __('footer.terms'); ?></a></li>
                    <li><a href="<?php echo url('privacidade'); ?>" class="hover:text-white transition"><?php echo __('footer.privacy'); ?></a></li>
                </ul>
            </div>
        </div>

        <div class="border-t border-slate-800 pt-8 flex flex-col md:flex-row justify-between items-center text-xs">
            <p>&copy; <?php echo date('Y'); ?> MediaConvert.net. <?php echo __('footer.rights'); ?></p>
            <!-- <div class="flex space-x-4 mt-4 md:mt-0">
                <span class="opacity-50">Orgulhosamente construído com PHP & Tailwind</span>
            </div> -->
        </div>
    </div>
</footer>

</body>
</html>