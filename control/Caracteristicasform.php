<?php

require_once './model/Caracteristicas.php';

    class Caracteristicasform{

            private $html;
            private $data;

            public function __construct(){
            
                $this->html=file_get_contents('./html/formCaracteristicas.html');
                $this->data=[
                    'cod_carac' => null,
                    'title' => null,
                    'description' => null
                ];
            
            }

            public function edit($param){
                try{
                    $cod_carac = (int) $param['cod_carac'];
                    $report = Caracteristicas::find($cod_carac);
                    $this->data = $report;
                    self::show();
                }
                catch(Exception $e){
                    print $e->getMessage();
                }

            }

            public function save($param){

                try{
                    //var_dump($param);
                    $cod_test = (int) Caracteristicas::save($param);
                    $this->data=$param; 
                    $this->data['cod_carac'] = $cod_test;
                    //var_dump($this->data);
                    self::show();
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
                
                $this->html = str_replace('{cod_carac}', $this->data['cod_carac'], $this->html);
                $this->html = str_replace('{title}', $this->data['title'], $this->html);
                $this->html = str_replace('{description}', $this->data['description'], $this->html);

                //estilização

                $bootstrapCSS = file_get_contents('./layout/css/bootstrap.min.css');
                $mdiCSS = file_get_contents('./layout/css/materialdesignicons.min.css');
                $tinySliderCSS = file_get_contents('./layout/css/tiny-slider.css');
                $swiperCSS = file_get_contents('./layout/css/swiper.min.css');
                $customCSS = file_get_contents('./layout/css/style.min.css');
                $colorsCSS = file_get_contents('./layout/css/colors/default.css');



                $styles = "<style>{$bootstrapCSS}{$mdiCSS}{$tinySliderCSS}{$swiperCSS}{$customCSS}{$colorsCSS}</style>";

                print $styles . $this->html;
            
            }

        }
?>
