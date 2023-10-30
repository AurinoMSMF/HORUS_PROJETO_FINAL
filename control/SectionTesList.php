<?php

require_once './model/SectionTes.php';


    class SectionTesList{
        private $html;

        public function __construct(){
            $this->html = file_get_contents('./html/ListTes.html');
        }

        public function load(){
            try{    
                $reports=SectionTes::all();
                //var_dump($reports);
                $items='';
                foreach($reports as $report){
                    $item = file_get_contents('./html/TesItems.html');
                    $item = str_replace('{cod_test}',$report['cod_test'],$item);
                    $item = str_replace('{name}', $report['name'], $item);
                    $item = str_replace('{function}', $report['function'], $item);
                    $item = str_replace('{title}', $report['title'], $item);
                    $item = str_replace('{description}', $report['description'], $item);
                    $item = str_replace('{picture}', $report['picture'], $item);
                    $item = str_replace('{background_img}', $report['background_img'], $item);
                    $item = str_replace('{css/bootstrap.min.css}','./layout/css/bootstrap.min.css', $item);
                    $item = str_replace('{css/materialdesignicons.min.css}','./layout/css/materialdesignicons.min.css', $item);
                    $item = str_replace('{css/bootstrap.min.css}','./layout/css/tiny-slider.css', $item);
                    $item = str_replace('{css/bootstrap.min.css}','./layout/css/swiper.min.css', $item);
                    $item = str_replace('{css/bootstrap.min.css}','./layout/css/style.min.css', $item);
                    $item = str_replace('{css/bootstrap.min.css}','./layout/css/colors/default.css', $item);
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

        public function show(){
            $this->load();
            print $this->html;
        }
    }
?>