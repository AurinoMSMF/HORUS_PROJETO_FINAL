<?php


    class Login{
        
        public $html;


        public function __construct() {
            $bootstrapCSS = file_get_contents('./layout/css/bootstrap.min.css');
            $mdiCSS = file_get_contents('./layout/css/materialdesignicons.min.css');
            $tinySliderCSS = file_get_contents('./layout/css/tiny-slider.css');
            $swiperCSS = file_get_contents('./layout/css/swiper.min.css');
            $customCSS = file_get_contents('./layout/css/style.min.css');
            $colorsCSS = file_get_contents('./layout/css/colors/default.css');
    
            // Carrega o conteúdo do arquivo HTML
            $html = file_get_contents('./html/Login.html');
    
            // Concatena o conteúdo dos arquivos CSS e HTML
            $styles = "<style>{$bootstrapCSS}{$mdiCSS}{$tinySliderCSS}{$swiperCSS}{$customCSS}{$colorsCSS}</style>";
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