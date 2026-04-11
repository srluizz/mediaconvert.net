<?php 
    $targetFormat = $_GET['to'] ?? 'jpg';
    include_once '../includes/i18n.php';
    $pageTitle = __('converter.step1_title') . " " . strtoupper($targetFormat) . " | MediaConvert.net";
    $pageDesc = __('converter.step1_subtitle');
    include '../components/header.php'; 
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
                            <div id="drop-zone" class="relative group border-4 border-dashed border-slate-200 rounded-2xl p-6 text-center transition-all hover:border-blue-400 cursor-pointer bg-slate-50/50 min-h-[300px] flex flex-col items-center justify-center">
                                <input type="file" id="file-input" class="hidden" accept="image/*" multiple>
                                
                                <div id="preview-grid" class="hidden w-full grid grid-cols-1 sm:grid-cols-2 gap-4 overflow-y-auto max-h-[400px] p-2 justify-items-center">
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

                                <button id="btn-reset-all" onclick="resetUpload(event)" class="hidden mt-4 bg-red-50 text-red-500 px-4 py-2 rounded-lg text-xs font-bold hover:bg-red-100 transition">
                                    Limpar Seleção
                                </button>
                            </div>

                            <div id="file-info" class="hidden bg-slate-50 rounded-xl p-4 border border-slate-100 animate-in fade-in slide-in-from-top-2 duration-300">
                                <div class="flex justify-between items-center mb-3">
                                    <h3 class="text-xs font-bold text-slate-400 uppercase tracking-widest">Arquivos Selecionados</h3>
                                    <span id="file-count-badge" class="bg-blue-600 text-white text-[10px] px-2 py-0.5 rounded-full"></span>
                                </div>
                                <div id="files-list" class="space-y-1 text-sm text-slate-900 font-medium max-h-32 overflow-y-auto">
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
                    <p class="text-slate-500 mb-6 font-medium"><?php echo __('converter.success_subtitle'); ?></p>
                    
                    <div id="bulk-download-container" class="mb-8 hidden">
                        <button onclick="downloadAll()" class="w-full max-w-md mx-auto flex items-center justify-center space-x-3 bg-blue-600 text-white py-4 rounded-2xl font-black text-lg shadow-xl hover:bg-blue-700 transition transform hover:scale-[1.02]">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path></svg>
                            <span><?php echo __('converter.bulk-download-container'); ?></span>
                        </button>
                    </div>

                    <div id="download-area" class="space-y-3 max-w-md mx-auto">
                    </div>

                    <div class="mt-10 pt-6 border-t border-slate-100">
                        <button onclick="location.reload()" class="bg-slate-100 text-slate-600 px-8 py-4 rounded-2xl font-bold hover:bg-slate-200 transition">
                            <?php echo __('converter.btn_new'); ?>
                        </button>
                    </div>
                </div>
            </div>

            <div class="mt-12 w-full bg-gradient-to-r from-blue-600 to-indigo-700 rounded-3xl p-8 shadow-lg shadow-blue-200/50 flex flex-col md:flex-row items-center justify-between border border-blue-400/20 overflow-hidden relative group">
                <div class="absolute -right-10 -top-10 w-40 h-40 bg-white/10 rounded-full blur-3xl transition-transform group-hover:scale-150 duration-700"></div>
                
                <div class="z-10 text-center md:text-left">
                    <h3 class="text-white text-2xl font-black mb-2 flex items-center justify-center md:justify-start gap-2">
                        <svg class="w-6 h-6 text-blue-200" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                        Precisa de um currículo novo?
                    </h3>
                    <p class="text-blue-100 font-medium max-w-md">Crie seu currículo profissional em minutos com o <span class="font-bold underline decoration-blue-300">CriarCV.online</span>. 100% gratuito e pronto para baixar!</p>
                </div>

                <div class="mt-6 md:mt-0 z-10 w-full md:w-auto">
                    <a href="https://criarcv.online" target="_blank" class="block w-full text-center bg-white text-blue-700 px-8 py-4 rounded-2xl font-black text-lg shadow-xl hover:bg-slate-50 transition transform hover:-translate-y-1 active:scale-95">
                        Criar Currículo Agora
                    </a>
                </div>
            </div>
            </div>
    </div>
</main>

<script>
    let selectedFiles = []; 
    let convertedFiles = []; 
    let selectedFormat = '<?php echo $targetFormat; ?>';
    const dropZone = document.getElementById('drop-zone');
    const fileInput = document.getElementById('file-input');
    const btnConvert = document.getElementById('btn-convert');
    const progressBar = document.getElementById('progress-bar');
    const previewGrid = document.getElementById('preview-grid');
    const uploadPrompt = document.getElementById('upload-prompt');
    const btnResetAll = document.getElementById('btn-reset-all');

    function setFormat(fmt) {
        selectedFormat = fmt;
        document.getElementById('display-format').innerText = fmt;
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
        if (e.dataTransfer.files.length) handleFiles(e.dataTransfer.files);
    };

    dropZone.onclick = (e) => {
        if (e.target === dropZone || uploadPrompt.contains(e.target)) {
            fileInput.click();
        }
    };

    fileInput.onchange = (e) => { if (e.target.files.length) handleFiles(e.target.files); };

    function handleFiles(files) {
        const newFiles = Array.from(files).filter(file => file.type.startsWith('image/'));
        if (newFiles.length === 0) {
            alert('Por favor, selecione apenas arquivos de imagem.');
            return;
        }

        selectedFiles = newFiles;
        previewGrid.innerHTML = ''; 
        
        selectedFiles.forEach((file) => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const div = document.createElement('div');
                div.className = "relative aspect-square bg-white rounded-lg border border-slate-200 overflow-hidden shadow-sm w-full max-w-[250px]";
                div.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">
                                 <div class="absolute bottom-0 inset-x-0 bg-black/50 text-[10px] text-white p-1 truncate">${file.name}</div>`;
                previewGrid.appendChild(div);
            };
            reader.readAsDataURL(file);
        });

        previewGrid.classList.remove('hidden');
        previewGrid.classList.add('grid');
        uploadPrompt.classList.add('hidden');
        btnResetAll.classList.remove('hidden');

        const list = document.getElementById('files-list');
        list.innerHTML = selectedFiles.map(f => `<div class="truncate text-slate-600 text-xs">• ${f.name}</div>`).join('');
        document.getElementById('file-info').classList.remove('hidden');
        document.getElementById('file-count-badge').innerText = selectedFiles.length;

        btnConvert.disabled = false;
        btnConvert.classList.remove('bg-slate-300', 'cursor-not-allowed');
        btnConvert.classList.add('bg-blue-600', 'hover:bg-blue-700');
    }

    function resetUpload(e) {
        if(e) e.stopPropagation();
        selectedFiles = [];
        fileInput.value = '';
        previewGrid.innerHTML = '';
        previewGrid.classList.add('hidden');
        uploadPrompt.classList.remove('hidden');
        btnResetAll.classList.add('hidden');
        document.getElementById('file-info').classList.add('hidden');
        btnConvert.disabled = true;
        btnConvert.classList.add('bg-slate-300', 'cursor-not-allowed');
    }

    function downloadAll() {
        convertedFiles.forEach((file, index) => {
            setTimeout(() => {
                const link = document.createElement('a');
                link.href = file.url;
                link.download = file.originalName;
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
            }, index * 250); 
        });
    }

    btnConvert.onclick = () => {
        if (selectedFiles.length === 0) return;
        
        document.getElementById('step-1').classList.add('hidden');
        document.getElementById('step-2').classList.remove('hidden');

        const formData = new FormData();
        selectedFiles.forEach((file) => {
            formData.append('images[]', file);
        });
        formData.append('format', selectedFormat);

        fetch('engine/process.php', {
            method: 'POST',
            body: formData
        })
        .then(async res => {
            const text = await res.text();
            let data;
            try { data = JSON.parse(text); } catch (e) { throw new Error('Resposta inválida do servidor.'); }
            
            if (!res.ok || !data.success) throw new Error(data.error || 'Erro no processamento');
            
            convertedFiles = data.files; 

            let progress = 0;
            const interval = setInterval(() => {
                progress += 5;
                progressBar.style.width = progress + '%';
                if (progress >= 100) {
                    clearInterval(interval);
                    
                    if (convertedFiles.length > 1) {
                        document.getElementById('bulk-download-container').classList.remove('hidden');
                    }

                    const downloadArea = document.getElementById('download-area');
                    downloadArea.innerHTML = convertedFiles.map(file => `
                        <a href="${file.url}" download class="flex items-center justify-between bg-white border border-slate-200 p-3 rounded-xl group hover:border-blue-400 transition-all">
                            <span class="truncate text-slate-700 font-bold text-xs max-w-[200px]">${file.originalName}</span>
                            <span class="text-blue-600 font-black text-[10px] uppercase tracking-tighter">Download</span>
                        </a>
                    `).join('');

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
<?php include '../components/footer.php'; ?>