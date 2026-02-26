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
        $browserFactory = new BrowserFactory();
        
        $browser = $browserFactory->createBrowser([
            'windowSize' => [$this->width, $this->height],
            'enableImages' => true,
            'noSandbox' => true,
            'customFlags' => [
                '--disable-gpu',                
                '--disable-software-rasterizer', 
                '--no-sandbox',                
                '--disable-dev-shm-usage',     
                '--remote-debugging-port=9222',  
                '--disable-setuid-sandbox'      
            ]
        ]);

        try {
            $page = $browser->createPage();
            $page->setHtml($this->html);
            
            usleep(500000); 

            $page->screenshot([
                'format'  => 'jpeg',
                'quality' => 95, 
            ])->saveToFile($path);
        } finally {
            $browser->close();
        }
    }
}