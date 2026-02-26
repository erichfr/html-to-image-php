<?php

namespace ErichFournier\HtmlToImagePhp;

use HeadlessChromium\BrowserFactory;

class HtmlConverter
{
    protected string $html;
    protected int $width = 370;
    protected int $height = 530;

    public function __construct(string $html)
    {
        $this->html = $html;
    }

    public static function make(string $html): self
    {
        return new static($html);
    }

    public function setDimensions(int $width, int $height): self
    {
        $this->width = $width;
        $this->height = $height;
        return $this;
    }

    public function save(string $path): void
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            @exec('taskkill /F /IM chrome.exe /T');
        }

        $browserFactory = new BrowserFactory();
        
        $browser = $browserFactory->createBrowser([
            'windowSize' => [$this->width, $this->height],
            'noSandbox' => true,
            'customFlags' => [
                '--disable-gpu',
                '--disable-software-rasterizer',
                '--remote-debugging-port=9222',
                '--disable-dev-shm-usage',
                '--no-first-run',
                '--no-default-browser-check'
            ]
        ]);

        try {
            usleep(1000000);

            $page = $browser->createPage();
            $page->setHtml($this->html);
            
            usleep(800000); 

            $page->screenshot([
                'format'  => 'jpeg',
                'quality' => 95,
            ])->saveToFile($path);

        } catch (\Exception $e) {
            throw new \Exception("Falha na renderização: " . $e->getMessage());
        } finally {
            $browser->close();
        }
    }
}