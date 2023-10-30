<?php

require_once './model/Caracteristicas.php';

    class CaracteristicasList{


        public function __construct(){ 
            $bootstrapCSS = file_get_contents('./layout/css/bootstrap.min.css');
            $mdiCSS = file_get_contents('./layout/css/materialdesignicons.min.css');
            $tinySliderCSS = file_get_contents('./layout/css/tiny-slider.css');
            $swiperCSS = file_get_contents('./layout/css/swiper.min.css');
            $customCSS = file_get_contents('./layout/css/style.min.css');
            $colorsCSS = file_get_contents('./layout/css/colors/default.css');
    
            // Carrega o conteúdo do arquivo HTML
            $html = file_get_contents('./html/ListagemUsuarios.html');

            $styles = "<style>{$bootstrapCSS}{$mdiCSS}{$tinySliderCSS}{$swiperCSS}{$customCSS}{$colorsCSS}</style>";
            $this->List = "{$styles}{$html}";

        }

        public static function load(){
            try {
                $Caracteristicas = Caracteristicas::all();
                $html = file_get_contents('./html/formCaracteristicas.html');
        
                while ($row = $Caracteristicas->fetch(PDO::FETCH_ASSOC)) {
                    $html = str_replace('{title' . $row['cod_carac'] . '}', $row['title'], $html);
                    $html = str_replace('{descricao' . $row['cod_carac'] . '}', $row['description'], $html);
                }
        
                // Estilos (css)
                $bootstrapCSS = file_get_contents('./layout/css/bootstrap.min.css');
                $mdiCSS = file_get_contents('./layout/css/materialdesignicons.min.css');
                $tinySliderCSS = file_get_contents('./layout/css/tiny-slider.css');
                $swiperCSS = file_get_contents('./layout/css/swiper.min.css');
                $customCSS = file_get_contents('./layout/css/style.min.css');
                $colorsCSS = file_get_contents('./layout/css/colors/default.css');
        
                $styles = "<style>{$bootstrapCSS}{$mdiCSS}{$tinySliderCSS}{$swiperCSS}{$customCSS}{$colorsCSS}</style>";
        
                print $styles . $html;
            } catch (Exception $e) {
                print $e->getMessage();
            }
        }

        public function PuxarDashboard() {
            $cadastroListagemUsuario = new Dashboard();
            $this->teste = $cadastroListagemUsuario->show();
        }

            public function show(){
                $this->PuxarDashboard();

    
                $conteudo = '<div style="height:1272px;">';
                $conteudo .= $this->teste;   
                self::load();
                $conteudo .= '</div>';
    
                print $conteudo;
    
            }
    
        public static function save($Caracteristicas){
            Caracteristicas::save($Caracteristicas);
            Caracteristicas::load();
        }
    }

?>