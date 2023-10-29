<?php

require_once './control/Connection.php';
require_once './control/Usuarios.php';

class UsuariosLogin {

    private $erroMessage = ''; // Inicialize com uma string vazia
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
            $erroMessage = Usuarios::ValidarLogin($param);
            $this->show($erroMessage);
        } catch (Exception $e) {
            // Trate exceções, se necessário
        }
    }

    public function show($erroMessage) {
    // Verifica se $erroMessage é um array
    if (is_array($erroMessage)) {
        // Se $erroMessage for um array, define $erroMessage como uma string vazia
        $erroMessage = '';
        $erroMessageString = $erroMessage;
    }else {
        // Se $erroMessage não for um array, assume que já é uma string
        $erroMessageString = $erroMessage;
    }

    // Atualiza a mensagem de erro no HTML antes de exibi-lo
    $this->html = str_replace('{erroMessage}', $erroMessageString, $this->html);
    print $this->html;
    }

}