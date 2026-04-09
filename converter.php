<?php 
    $targetFormat = $_GET['to'] ?? 'jpg';
    include_once 'includes/i18n.php';
    $pageTitle = __('converter.step1_title') . " " . strtoupper($targetFormat) . " | MediaConvert.net";
    $pageDesc = __('converter.step1_subtitle');
    include 'components/header.php'; 
?>

<main class="flex-grow bg-slate-50 py-12">
    <div class="container mx-auto px-4">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-10">
                <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900 mb-2">
                    <?php echo __('converter.step1_title'); ?> <span class="text-blue-600 uppercase" id="display-format"><?php echo $targetFormat; ?></span>
                </h1>
                <p class="text-slate-500"><?php echo __('converter.step1_subtitle'); ?></p>
            </div>

            <div class="bg-white rounded-3xl shadow-xl shadow-slate-200/60 overflow-hidden border border-slate-100">
                <div id="step-1" class="p-8 md:p-12">
                    <div class="grid md:grid-cols-2 gap-10 items-start">
                        <div class="space-y-4">
                            <div id="drop-zone" class="relative group border-4 border-dashed border-slate-200 rounded-2xl p-10 text-center transition-all hover:border-blue-400 cursor-pointer bg-slate-50/50 min-h-[250px] flex items-center justify-center">
                                <input type="file" id="file-input" class="hidden" accept="image/*">
                                
                                <div id="preview-container" class="hidden absolute inset-0 bg-white rounded-xl p-2 flex items-center justify-center">
                                    <img id="img-preview" class="max-w-full max-h-full object-contain rounded-lg">
                                    <button onclick="resetUpload(event)" class="absolute -top-2 -right-2 bg-red-500 text-white rounded-full p-1 shadow-lg hover:bg-red-600 z-10">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path d="M6 18L18 6M6 6l12 12" stroke-width="3"/></svg>
                                    </button>
                                </div>

                                <div id="upload-prompt" class="space-y-4">
                                    <div class="w-16 h-16 bg-blue-100 text-blue-600 rounded-full flex items-center justify-center mx-auto group-hover:scale-110 transition-transform">
                                        <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                                    </div>
                                    <div>
                                        <p class="font-bold text-slate-700"><?php echo __('converter.upload_label'); ?></p>
                                        <p class="text-sm text-slate-400"><?php echo __('converter.upload_hint'); ?></p>
                                    </div>
                                </div>
                            </div>

                            <div id="file-info" class="hidden bg-slate-50 rounded-xl p-4 border border-slate-100 animate-in fade-in slide-in-from-top-2 duration-300">
                                <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-3">Informações do Arquivo</h3>
                                <div class="grid grid-cols-2 gap-y-2 text-sm">
                                    <span class="text-slate-500">Nome:</span>
                                    <span id="info-name" class="text-slate-900 font-medium truncate"></span>
                                    
                                    <span class="text-slate-500">Tamanho:</span>
                                    <span id="info-size" class="text-slate-900 font-medium"></span>
                                    
                                    <span class="text-slate-500">Resolução:</span>
                                    <span id="info-resolution" class="text-slate-900 font-medium"></span>
                                    
                                    <span class="text-slate-500">Formato:</span>
                                    <span id="info-type" class="text-slate-900 font-medium uppercase"></span>
                                </div>
                            </div>
                        </div>

                        <div class="space-y-6">
                            <div>
                                <label class="block text-sm font-bold text-slate-700 mb-3 uppercase tracking-wider"><?php echo __('converter.label_convert_to'); ?></label>
                                <div class="grid grid-cols-3 gap-2">
                                    <?php 
                                    $formats = ['jpg', 'png', 'webp', 'tiff', 'gif', 'bmp', 'ico'];
                                    foreach($formats as $f): 
                                        $active = ($f == $targetFormat) ? 'ring-2 ring-blue-600 bg-blue-50 text-blue-600' : 'bg-slate-100 text-slate-600 hover:bg-slate-200';
                                    ?>
                                        <button onclick="setFormat('<?php echo $f; ?>')" class="format-option py-3 rounded-xl font-bold text-sm transition-all <?php echo $active; ?>" data-format="<?php echo $f; ?>">
                                            <?php echo strtoupper($f); ?>
                                        </button>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                            <button id="btn-convert" disabled class="w-full bg-slate-300 text-white py-4 rounded-2xl font-black text-lg shadow-lg cursor-not-allowed transition-all uppercase tracking-widest hover:shadow-blue-200/50">
                                <?php echo __('converter.btn_start'); ?>
                            </button>
                        </div>
                    </div>
                </div>

                <div id="step-2" class="hidden p-12 text-center bg-white">
                    <div class="relative w-24 h-24 mx-auto mb-8">
                        <div class="absolute inset-0 border-8 border-slate-100 rounded-full"></div>
                        <div class="absolute inset-0 border-8 border-blue-600 border-t-transparent rounded-full animate-spin"></div>
                    </div>
                    <h2 class="text-2xl font-black text-slate-800 mb-3"><?php echo __('converter.loading_title'); ?></h2>
                    <p class="text-slate-500 mb-8 max-w-xs mx-auto text-sm italic"><?php echo __('converter.loading_subtitle'); ?></p>
                    <div class="w-full bg-slate-100 rounded-full h-3 max-w-md mx-auto overflow-hidden">
                        <div id="progress-bar" class="bg-blue-600 h-full w-0 transition-all duration-300"></div>
                    </div>
                </div>

                <div id="step-3" class="hidden p-12 text-center bg-white">
                    <div class="bg-green-100 text-green-600 w-20 h-20 rounded-full flex items-center justify-center mx-auto mb-6 shadow-inner">
                        <svg class="w-10 h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                    </div>
                    <h2 class="text-3xl font-black text-slate-900 mb-2"><?php echo __('converter.success_title'); ?></h2>
                    <p class="text-slate-500 mb-10 font-medium"><?php echo __('converter.success_subtitle'); ?></p>
                    <div class="flex flex-col sm:flex-row gap-4 justify-center">
                        <a href="#" id="final-download" download class="bg-blue-600 text-white px-12 py-5 rounded-2xl font-bold text-xl shadow-2xl shadow-blue-200 hover:bg-blue-700 transition transform hover:scale-105">
                            <?php echo __('converter.btn_download'); ?> .<span id="ext-label"><?php echo $targetFormat; ?></span>
                        </a>
                        <button onclick="location.reload()" class="bg-slate-100 text-slate-600 px-8 py-5 rounded-2xl font-bold hover:bg-slate-200 transition">
                            <?php echo __('converter.btn_new'); ?>
                        </button>
                    </div>
                </div>
            </div>

            <div class="mt-12 w-full h-32 bg-slate-200 rounded-2xl flex items-center justify-center border-2 border-dashed border-slate-300 italic text-slate-400">
                Ads Placeholder
            </div>
        </div>
    </div>
</main>

<script>
    let selectedFile = null;
    let selectedFormat = '<?php echo $targetFormat; ?>';
    const dropZone = document.getElementById('drop-zone');
    const fileInput = document.getElementById('file-input');
    const btnConvert = document.getElementById('btn-convert');
    const progressBar = document.getElementById('progress-bar');

    function setFormat(fmt) {
        selectedFormat = fmt;
        document.getElementById('display-format').innerText = fmt;
        document.getElementById('ext-label').innerText = fmt;
        
        const mainTitle = "<?php echo __('converter.step1_title'); ?>";
        document.title = mainTitle + " " + fmt.toUpperCase() + " | MediaConvert.net";

        document.querySelectorAll('.format-option').forEach(btn => {
            btn.classList.remove('ring-2', 'ring-blue-600', 'bg-blue-50', 'text-blue-600');
            btn.classList.add('bg-slate-100', 'text-slate-600');
        });
        const activeBtn = document.querySelector(`[data-format="${fmt}"]`);
        activeBtn.classList.add('ring-2', 'ring-blue-600', 'bg-blue-50', 'text-blue-600');
    }

    dropZone.ondragover = (e) => { e.preventDefault(); dropZone.classList.add('border-blue-500', 'bg-blue-50'); };
    dropZone.ondragleave = () => { dropZone.classList.remove('border-blue-500', 'bg-blue-50'); };
    dropZone.ondrop = (e) => {
        e.preventDefault();
        dropZone.classList.remove('border-blue-500', 'bg-blue-50');
        if (e.dataTransfer.files.length) handleFile(e.dataTransfer.files[0]);
    };

    dropZone.onclick = () => fileInput.click();
    fileInput.onchange = (e) => { if (e.target.files.length) handleFile(e.target.files[0]); };

    function handleFile(file) {
        if (!file.type.startsWith('image/')) {
            alert('Por favor, selecione apenas arquivos de imagem.');
            return;
        }

        selectedFile = file;
        const reader = new FileReader();
        
        reader.onload = (e) => {
            const img = new Image();
            img.onload = () => {
                document.getElementById('info-name').innerText = file.name;
                document.getElementById('info-size').innerText = formatBytes(file.size);
                document.getElementById('info-type').innerText = file.type.split('/')[1];
                document.getElementById('info-resolution').innerText = `${img.width} x ${img.height} px`;
                
                document.getElementById('img-preview').src = e.target.result;
                document.getElementById('preview-container').classList.remove('hidden');
                document.getElementById('upload-prompt').classList.add('hidden');
                document.getElementById('file-info').classList.remove('hidden');
            };
            img.src = e.target.result;
        };
        reader.readAsDataURL(file);

        btnConvert.disabled = false;
        btnConvert.classList.remove('bg-slate-300', 'cursor-not-allowed');
        btnConvert.classList.add('bg-blue-600', 'hover:bg-blue-700');
    }

    function formatBytes(bytes, decimals = 2) {
        if (bytes === 0) return '0 Bytes';
        const k = 1024;
        const dm = decimals < 0 ? 0 : decimals;
        const sizes = ['Bytes', 'KB', 'MB', 'GB'];
        const i = Math.floor(Math.log(bytes) / Math.log(k));
        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }

    function resetUpload(e) {
        e.stopPropagation();
        selectedFile = null;
        fileInput.value = '';
        document.getElementById('preview-container').classList.add('hidden');
        document.getElementById('file-info').classList.add('hidden');
        document.getElementById('upload-prompt').classList.remove('hidden');
        btnConvert.disabled = true;
        btnConvert.classList.add('bg-slate-300', 'cursor-not-allowed');
    }

    btnConvert.onclick = () => {
        if (!selectedFile) return;
        
        document.getElementById('step-1').classList.add('hidden');
        document.getElementById('step-2').classList.remove('hidden');

        const formData = new FormData();
        formData.append('image', selectedFile);
        formData.append('format', selectedFormat);

        fetch('/process.php', {
            method: 'POST',
            body: formData
        })
        .then(async res => {
            const text = await res.text();
            let data;
            try { data = JSON.parse(text); } catch (e) { throw new Error('Resposta inválida do servidor.'); }
            
            if (!res.ok || !data.success) throw new Error(data.error || 'Erro no processamento');
            
            let progress = 0;
            const interval = setInterval(() => {
                progress += 5;
                progressBar.style.width = progress + '%';
                if (progress >= 100) {
                    clearInterval(interval);
                    document.getElementById('final-download').href = data.downloadUrl;
                    document.getElementById('step-2').classList.add('hidden');
                    document.getElementById('step-3').classList.remove('hidden');
                }
            }, 30);
        })
        .catch((err) => {
            console.error('Erro:', err);
            alert('Erro: ' + err.message);
            document.getElementById('step-2').classList.add('hidden');
            document.getElementById('step-1').classList.remove('hidden');
        });
    };
</script>

<?php include 'components/footer.php'; ?>