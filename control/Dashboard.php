<?php


    class Dashboard{
        
        public $html;
        public $conteudo;


        public function __construct() {
            $bootstrapCSS = file_get_contents('./layout/css/bootstrap.min.css');
            $css= file_get_contents('./layout/css/StyleSideBar.css');
    
            // Carrega o conteúdo do arquivo HTML
            $html = file_get_contents('./html/SideBar.html');
    
            // Concatena o conteúdo dos arquivos CSS e HTML
            $styles = "<style>{$bootstrapCSS}{$css}</style>";
            $this->html = "{$styles}{$html}";
        }
        public function CreateUser() {
            $cadastroListagemUsuario = new CadastroListagemUsuario();
            ob_start();
            $cadastroListagemUsuario->show();
            $this->conteudo = ob_get_clean();
            $sidebarContent = file_get_contents('./html/SideBar.html');
            $sidebarContent = str_replace('{Conteudos}', $this->conteudo, $sidebarContent);
            $bootstrapCSS = file_get_contents('./layout/css/bootstrap.min.css');
            $css = file_get_contents('./layout/css/StyleSideBar.css');
            $styles = "<style>{$bootstrapCSS}{$css}</style>";
            $this->html = "{$styles}{$sidebarContent}";
        }

        public  function show(){
            print $this->html;

        }
    }