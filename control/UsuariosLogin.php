<?php

require_once './Control/Connection.php';
require_once './control/Usuarios.php';

class UsuariosLogin {

    private $erroMessage; // Agora é uma propriedade privada da classe
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
    public function Validar($param) {
        try {
            $this->erroMessage = Usuarios::ValidarLogin($param);
            }   
            catch (Exception $e) {
            }
            
    }

    public function show() {
        // Atualiza a mensagem de erro no HTML antes de exibi-lo
        $this->html = str_replace('{erroMessage}', $this->erroMessage, $this->html);
        print $this->html;
    }


}