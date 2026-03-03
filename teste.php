<?php

require 'vendor/autoload.php';

use ErichFournier\HtmlToImagePhp\HtmlConverter;

$html = "
<div style='background-color: #ffffff; padding: 40px; font-family: Segoe UI, Roboto, Helvetica, Arial, sans-serif; max-width: 500px; margin: auto; border-radius: 8px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); border: 1px solid #e2e8f0;'>
    <div style='text-align: center;'>
        <div style='background: #4a5568; width: 60px; height: 60px; border-radius: 50%; margin: 0 auto 20px auto; line-height: 60px; color: white; font-size: 24px; font-weight: bold;'>
            EF
        </div>
        <h1 style='color: #1a202c; margin: 0 0 10px 0; font-size: 24px;'>Relatório de Atividade</h1>
        <p style='color: #4a5568; font-size: 16px; margin: 0 0 30px 0;'>Sistema de Gestão Erich Fournier</p>
    </div>

    <div style='border-top: 1px solid #edf2f7; padding-top: 20px;'>
        <div style='display: block; margin-bottom: 15px;'>
            <span style='color: #718096; font-size: 12px; text-transform: uppercase; font-weight: bold; display: block;'>Status do Processo</span>
            <span style='color: #38a169; font-weight: 600; display: block;'>Concluído com Sucesso</span>
        </div>
        
        <div style='display: block; margin-bottom: 15px;'>
            <span style='color: #718096; font-size: 12px; text-transform: uppercase; font-weight: bold; display: block;'>Data da Operação</span>
            <span style='color: #2d3748; display: block;'>" . date('d/m/Y') . "</span>
        </div>
    </div>

    <div style='background: #f7fafc; padding: 15px; border-radius: 4px; margin-top: 20px; text-align: center; color: #4a5568; font-size: 14px;'>
        Este é um documento de validação técnica gerado automaticamente.
    </div>
</div>";
 
try {
    HtmlConverter::make($html)
        ->setDimensions(500, 650)
        ->save(__DIR__ . '/resultado.jpg');
    echo "Sucesso! Imagem gerada.";
} catch (\Exception $e) {
    echo "Erro: " . $e->getMessage();
}