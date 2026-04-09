# MediaConvert.net 🚀

![Banner do MediaConvert](https://img.lightshot.app/QsAaQD_cS323aEPFOSdEzw.png)

> **Conversor de imagens profissional, rápido e focado em privacidade.**

O **MediaConvert.net** é uma ferramenta Full Stack desenvolvida para converter diversos formatos de imagem diretamente no navegador. O projeto foca em alta performance com ImageMagick e uma arquitetura escalável para múltiplos idiomas.

## 🌐 Demonstração Online
**Acesse agora:** [https://mediaconvert.net](https://mediaconvert.net)

---

## 🚀 Recursos principais

- **Conversão Profissional:** Processamento de nível de servidor via ImageMagick (`php-imagick`).
- **Privacidade Total:** Rotina automatizada de exclusão de arquivos após 30 minutos.
- **SEO Internacional:** Implementação de tags `hreflang`, rotas dinâmicas e sitemap XML para 5 idiomas.
- **UX Moderna:** Interface responsiva com Tailwind CSS, suporte a Drag & Drop e progresso real de conversão.
- **Multilingue:** Suporte nativo para PT, EN, ES, DE e AR (com suporte a RTL).

## 🛠️ Tecnologias Utilizadas

- **Backend:** PHP 8.x
- **Processamento:** ImageMagick (MagickWand API)
- **Frontend:** JavaScript (ES6+), Tailwind CSS, Fetch API
- **DevOps:** Cron Jobs para limpeza automática, Configuração de `.htaccess` para segurança de diretório
- **Arquitetura:** Sistema i18n customizado (JSON-based)

## 📁 Estrutura do Projeto

```text
├── components/     # Componentes de UI reaproveitáveis
├── includes/       # Lógica central e internacionalização (i18n)
├── locales/        # Dicionários JSON para traduções
├── uploads/        # Diretório temporário (Protegido via .htaccess)
├── cleanup.php     # Script de manutenção automática
├── process.php     # Engine de processamento de imagens
└── router.php      # Gerenciamento de rotas amigáveis
