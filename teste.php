<?php

require 'vendor/autoload.php';

use ErichFournier\HtmlToImagePhp\HtmlConverter;

$html = "<h1 style='text-align: center; color: #ffffff;'>Recibo Erich</h1><p style='text-align: center; color: #ffffff;'>Teste de conversão direta.</p>";

try {
    HtmlConverter::make($html)
        ->setDimensions(370, 530)
        ->save(__DIR__ . '/resultado.jpg');
    echo "Sucesso! Imagem gerada.";
} catch (\Exception $e) {
    echo "Erro: " . $e->getMessage();
}