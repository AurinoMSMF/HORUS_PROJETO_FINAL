<?php

require_once './model/Caracteristicas.php';


    class CaracteristicasList{
        public $html;

        public function __construct(){
            $bootstrapCSS = file_get_contents('./layout/css/bootstrap.min.css');
            $mdiCSS = file_get_contents('./layout/css/materialdesignicons.min.css');
            $tinySliderCSS = file_get_contents('./layout/css/tiny-slider.css');
            $swiperCSS = file_get_contents('./layout/css/swiper.min.css');
            $customCSS = file_get_contents('./layout/css/style.min.css');
            $colorsCSS = file_get_contents('./layout/css/colors/default.css');
    
            // Carrega o conteúdo do arquivo HTML
            $html = file_get_contents('./html/ListCaracteristicas.html');
            $styles = "<style>{$bootstrapCSS}{$mdiCSS}{$tinySliderCSS}{$swiperCSS}{$customCSS}{$colorsCSS}</style>";
            $this->html = "{$styles}{$html}";
        }

        public function load(){
            try{    
                $reports=Caracteristicas::all();
                //var_dump($reports);
                $items='';
                foreach($reports as $report){
                    $item = file_get_contents('./html/ItemsCaracteristicas.html');
                    $item = str_replace('{cod_carac}',$report['cod_carac'],$item);
                    $item = str_replace('{title}', $report['title'], $item);
                    $item = str_replace('{description}', $report['description'], $item);
                    $items.=$item;
                }

                $bootstrapCSS = file_get_contents('./layout/css/bootstrap.min.css');
                $mdiCSS = file_get_contents('./layout/css/materialdesignicons.min.css');
                $tinySliderCSS = file_get_contents('./layout/css/tiny-slider.css');
                $swiperCSS = file_get_contents('./layout/css/swiper.min.css');
                $customCSS = file_get_contents('./layout/css/style.min.css');
                $colorsCSS = file_get_contents('./layout/css/colors/default.css');



                $styles = "<style>{$bootstrapCSS}{$mdiCSS}{$tinySliderCSS}{$swiperCSS}{$customCSS}{$colorsCSS}</style>";
                $this->html = $styles . str_replace('{items}',$items, $this->html);
            } 
            catch(Exception $e){
                print $e->getMessage();
            }
        }
        public function PuxarDashboard() {
            $cadastroListagemUsuario = new Dashboard();
            $this->teste = $cadastroListagemUsuario->show();    
        }

        public function show(){
            $this->load();
            $this->PuxarDashboard();

            $conteudo = '<div style="display: flex; flex-direction: column; justify-content: center; 
            padding-left: 130px;">';
            $conteudo .= $this->html;   
            $conteudo .= $this->teste;   
            $conteudo .= '</div>';

            print $conteudo;
        }
    }
?>