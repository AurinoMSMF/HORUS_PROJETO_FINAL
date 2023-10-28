<?php


    class Dashboard{
        
        public $html;


        public function __construct() {
            $bootstrapCSS = file_get_contents('./layout/css/bootstrap.min.css');
            $css= file_get_contents('./layout/css/StyleSideBar.css');
    
            // Carrega o conteúdo do arquivo HTML
            $html = file_get_contents('./html/SideBar.html');
    
            // Concatena o conteúdo dos arquivos CSS e HTML
            $styles = "<style>{$bootstrapCSS}{$css}</style>";
            $this->html = "{$styles}{$html}";
        }

        public function ValidarLogin($param){
            if ($_SERVER['REQUEST_METHOD'] === 'POST') {

                if (isset($_POST['Usuario']) && isset($_POST['Senha'])) {
                    // Se 'Usuario' e 'Senha' foram enviados via POST
                    
                    $usuario = $_POST['Usuario'];
                    $senha = $_POST['Senha'];
                    if($usuario == 'admin' && $senha == 'admin'){
                        header("Location: index.php?class=Dashboard");
                    }

                }
            }
            
        }

        public  function show(){
            print $this->html;

        }
    }