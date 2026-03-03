# HTML to Image PHP

Uma biblioteca leve e eficiente para converter strings HTML em imagens (JPEG) utilizando o **Google Chrome em modo Headless**. 

---

## ✨ Características

* **Conversão Direta:** Transforma HTML/CSS complexos em imagens de alta qualidade.
* **Controle de Dimensões:** Defina largura e altura customizadas para cada captura.
* **Otimizado para Windows/Linux:** Inclui flags de estabilidade para evitar erros comuns de inicialização do navegador.
* **Fácil Integração:** Interface fluida e estática para implementação rápida em projetos Laravel ou PHP puro.

---

## 🚀 Instalação

Instale o pacote via **Composer**:

```bash
composer require erichfournier/html-to-image-php

```
Este pacote requer que o Google Chrome ou Chromium esteja instalado no servidor ou na máquina local.

---

## 🛠️ Requisitos de Sistema

* PHP: 8.1 ou superior.
* Extensões: ext-sockets habilitada.
* Navegador: Google Chrome instalado e disponível no PATH do sistema.

---

## 📖 Como usar

```php

use ErichFournier\HtmlToImagePhp\HtmlConverter;

$html = "<h1>Olá Mundo!</h1><p>Gerando imagem com PHP.</p>";

HtmlConverter::make($html)
    ->setDimensions(500, 600)
    ->save('caminho/do/arquivo.jpg');

```

```php

try {
    $html = view('recibos.venda', compact('venda'))->render();
    $path = public_path('recibos/recibo_' . $venda->id . '.jpg');

    \ErichFournier\HtmlToImagePhp\HtmlConverter::make($html)
        ->setDimensions(500, 650)
        ->save($path);

    return response()->json(['message' => 'Imagem gerada com sucesso!']);
} catch (\Exception $e) {
    return response()->json(['error' => $e->getMessage()], 500);
}

```

![Gravando 2026-03-03 114633](https://github.com/user-attachments/assets/61c5adf6-16e4-47ab-834a-1eb6e95d4e5d)


---

## ⚙️ Configurações de Estabilidade

O método save() implementa automaticamente flags para garantir a execução estável em ambientes como Docker, Laragon ou XAMPP:

* --disable-gpu: Essencial para servidores sem interface gráfica.
* --no-sandbox: Melhora a compatibilidade em kernels Linux.
* --remote-debugging-port=9222: Garante a comunicação estável via DevTools.
* Render Delay: Utiliza um usleep() estratégico para aguardar o carregamento de fontes e CSS antes do screenshot.

--- 

## 📄 Licença
Distribuído sob a licença MIT. Veja LICENSE para mais informações.



