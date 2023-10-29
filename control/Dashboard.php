<?php


    class Dashboard{
        
        public $html;
        public $conteudo;


        public function __construct() {
            $bootstrapCSS = file_get_contents('./layout/css/bootstrap.min.css');
            $css= file_get_contents('./layout/css/styleSideBar.css');
    
            // Carrega o conteúdo do arquivo HTML
            $html = file_get_contents('./html/SideBar.html');
    
            // Concatena o conteúdo dos arquivos CSS e HTML
            $styles = "<style>{$bootstrapCSS}{$css}</style>";
            $this->html = "{$styles}{$html}";
        }

        public  function show(){
            print $this->html;

        }
    }