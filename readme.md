# MediaConvert.net

![Banner do MediaConvert](https://img.lightshot.app/QsAaQD_cS323aEPFOSdEzw.png)

MediaConvert.net é uma ferramenta de conversão de imagens online rápida, segura e focada na privacidade. Ela permite que os usuários convertam diversos formatos de imagem com facilidade, garantindo alta qualidade e a exclusão automática dos arquivos após o processamento.

## 🌐 Demonstração Online
**Acesse agora:** [https://mediaconvert.net](https://mediaconvert.net)

## Índice

- [Recursos](#recursos)
- [Formatos Suportados](#formatos-suportados)
- [Tecnologias Utilizadas](#tecnologias-utilizadas)
- [Instalação](#instalação)
- [Uso](#uso)
- [Estrutura de Arquivos](#estrutura-de-arquivos)
- [Privacidade e Manipulação de Dados](#privacidade-e-manipulação-de-dados)
- [Contribuição](#contribuição)
- [Licença](#licença)

## 🚀 Recursos principais

- **Conversão Profissional:** Processamento de nível de servidor via ImageMagick (`php-imagick`).
- **Privacidade Total:** Rotina automatizada de exclusão de arquivos após 30 minutos.
- **SEO Internacional:** Implementação de tags `hreflang`, rotas dinâmicas e sitemap XML para 5 idiomas.
- **UX Moderna:** Interface responsiva com Tailwind CSS, suporte a Drag & Drop e progresso real de conversão.
- **Multilingue:** Suporte nativo para PT, EN, ES, DE e AR (com suporte a RTL).

## Formatos Suportados

O MediaConvert.net suporta conversão de e para os seguintes formatos de imagem:

- JPG
- PNG
- WEBP
- TIFF
- GIF
- BMP
- ICO

## 🛠️ Tecnologias Utilizadas

- **Backend:** PHP 8.x
- **Processamento:** ImageMagick (MagickWand API)
- **Frontend:** JavaScript (ES6+), Tailwind CSS, Fetch API
- **DevOps:** Cron Jobs para limpeza automática, Configuração de `.htaccess` para segurança de diretório
- **Arquitetura:** Sistema i18n customizado (JSON-based)
## Instalação

Para configurar o MediaConvert.net localmente, siga estes passos:

1.  **Clonar o repositório:**
    ```bash
    git clone [https://github.com/seu-usuario/mediaconvert_github.git](https://github.com/seu-usuario/mediaconvert_github.git)
    cd mediaconvert_github
    ```
2.  **Configuração do Servidor Web:**
    Configure seu servidor web (Apache, Nginx, etc.) para apontar o diretório raiz (document root) para `c:\xampp\htdocs\mediaconvert_github`.
3.  **Requisitos do PHP:**
    Certifique-se de que o PHP está instalado com a extensão `imagick` habilitada. Você pode precisar instalá-la via gerenciador de pacotes do seu sistema ou PECL.
    Exemplo no Ubuntu:
    ```bash
    sudo apt-get install imagemagick php-imagick
    sudo phpenmod imagick
    sudo systemctl restart apache2 # ou nginx
    ```
4.  **Permissões de Diretório:**
    Certifique-se de que o diretório `uploads/` tenha permissões de escrita para o servidor web.
    ```bash
    chmod -R 777 uploads/
    ```
    (Nota: `777` é para fins de desenvolvimento. Para produção, use permissões mais restritivas como `775` ou `755` e garanta que o usuário do servidor web seja o dono do diretório.)

## Uso

1.  Abra seu navegador e navegue até o domínio ou endereço IP configurado.
2.  Arraste e solte um arquivo de imagem na área designada ou clique para selecionar um.
3.  Escolha o formato de saída desejado.
4.  Clique em "Iniciar Conversão" e depois em "Baixar Arquivo" assim que concluído.

## Estrutura de Arquivos

- `router.php`: Gerencia o roteamento de URL para diferentes páginas e idiomas.
- `includes/i18n.php`: Fornece funções de internacionalização.
- `locales/`: Contém arquivos JSON para as traduções de diferentes idiomas.
- `uploads/`: Diretório temporário para arquivos enviados e convertidos.
- `components/`: Componentes de UI reutilizáveis (ex: cabeçalho, rodapé).

### Páginas (`/pages`)
- `pages/index.php`: A página inicial principal.
- `pages/converter.php`: Interface de conversão.
- `pages/privacidade.php`: Política de Privacidade.
- `pages/termos.php`: Termos de Uso.

### Backend & Scripts
- `pages/engine/process.php`: Lógica de conversão de imagem.
- `scripts/cleanup.php`: Rotina de limpeza do diretório de uploads.

## Privacidade e Manipulação de Dados

O MediaConvert.net foi construído com a privacidade em mente.
- Os arquivos são processados temporariamente na memória ou no disco.
- Arquivos enviados e convertidos são excluídos automaticamente do servidor após um curto período (ex: 30 minutos) por uma rotina de limpeza automatizada (`cleanup.php`).
- Nenhum dado pessoal é armazenado permanentemente.

## Contribuição

Contribuições são bem-vindas! Sinta-se à vontade para enviar pull requests ou abrir issues para quaisquer bugs ou solicitações de recursos.

## Licença

Este projeto é de código aberto e está disponível sob a Licença MIT.
