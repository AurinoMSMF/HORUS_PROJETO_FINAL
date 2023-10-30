<?php

require_once './model/SectionTes.php';

    class SectionTesForm{

            private $html;
            private $data;

            public function __construct(){
            
                $this->html=file_get_contents('./html/formTes.html');
                $this->data=[
                    'cod_test' => null,
                    'name' => null,
                    'function' => null,
                    'title' => null,
                    'description' => null,
                ];
            
            }

            public function edit($param){
                try{
                    $cod_test = (int) $param['cod_test'];
                    $report = SectionTes::find($cod_test);
                    //var_dump($report);
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
                    $cod_test = (int) SectionTes::save($param);
                    $this->data=$param; 
                    $this->data['cod_test'] = $cod_test;
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
                
                $this->html = str_replace('{cod_test}', $this->data['cod_test'], $this->html);
                $this->html = str_replace('{name}', $this->data['name'], $this->html);
                $this->html = str_replace('{function}', $this->data['function'], $this->html);
                $this->html = str_replace('{title}', $this->data['title'], $this->html);
                $this->html = str_replace('{description}', $this->data['description'], $this->html);
                // $this->html = str_replace('{picture}', $this->data['picture'], $this->html);
                // $this->html = str_replace('{background_img}', $this->data['background_img'], $this->html);

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
