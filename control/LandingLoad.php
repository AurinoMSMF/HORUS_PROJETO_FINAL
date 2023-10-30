<?php
require_once './model/Preference.php';
require_once './model/Caracteristicas.php';
require_once './model/SectionTes.php';


class LandingLoad{

        public function __construct(){ 
        }

        public static function load(){
                try {
                    $preferences = Preference::all();
                    $Caracteristicas = Caracteristicas::all();
                    $sections = SectionTes::all();


                    $html = $styles . file_get_contents('./layout/index.html');

                    foreach ($preferences as $preference) {
                        //echo $preference['landing_title'];
                        $html = str_replace('{landing_title}', $preferences['landing_title'], $html);
                        $html = str_replace('{favicon}', './layout/uploaded/'.$preferences['favicon'], $html);
                        $html = str_replace('{header_logo}', './layout/uploaded/'.$preferences['header_logo'], $html);
                        $html = str_replace('{link_facebook}', $preferences['link_facebook'], $html);
                        $html = str_replace('{link_instagram}', $preferences['link_instagram'], $html);
                        $html = str_replace('{section_home_title}', $preferences['section_home_title'], $html);
                        $html = str_replace('{section_home_subtitle}', $preferences['section_home_subtitle'], $html);
                        $html = str_replace('{section_home_img}', './layout/uploaded/'.$preferences['section_home_img'], $html);
                        $html = str_replace('{section_home_carac_title}', $preferences['section_home_carac_title'], $html);
                        $html = str_replace('{section_report_title}', $preferences['section_report_title'], $html);
                        $html = str_replace('{section_appstore_title}', $preferences['section_appstore_title'], $html);
                        $html = str_replace('{section_appstore_subtitle}', $preferences['section_appstore_subtitle'], $html);
                        $html = str_replace('{section_appstore_img}', './layout/uploaded/'.$preferences['section_appstore_img'], $html);
                        $html = str_replace('{section_appstore_img_app}', './layout/uploaded/'.$preferences['section_appstore_img_app'], $html);
                        $html = str_replace('{section_appstore_img_play}', './layout/uploaded/'.$preferences['section_appstore_img_play'], $html);
                        $html = str_replace('{phone_field}', $preferences['phone_field'], $html);
                        $html = str_replace('{footer_logo}', './layout/uploaded/'.$preferences['footer_logo'], $html);
                        $html = str_replace('{footer_copyright_field}', $preferences['footer_copyright_field'], $html);
                        $html = str_replace('{footer_url_field}', $preferences['footer_url_field'], $html);
                        $html = str_replace('{footer_powered_field}', $preferences['footer_powered_field'], $html);
                        // Adicione mais substituições conforme necessário para outras colunas do banco de dados.
                    }
                    $i = 1;
                    foreach ($Caracteristicas as $caracteristica) {
                         $html = str_replace("{title$i}", $caracteristica['title'], $html);
                         $html = str_replace("{description$i}", $caracteristica['description'], $html);
                         $i++;
                         if ($i > 4) {
                             break; // Só temos 4 tags {title} e {caracteristica}
                                 }
                                  }   
                    
                    //TESTEMUNHO UM

                    $html = str_replace('{name_um}',$sections[0]['name'],$html);
                    $html = str_replace('{function_um}',$sections[0]['function'],$html);
                    $html = str_replace('{title_um}',$sections[0]['title'],$html);
                    $html = str_replace('{description_um}',$sections[0]['description'],$html);
                    $html = str_replace('{images/user/img-1.jpg}','./layout/images/user/img-1.jpg',$html);
                    $html = str_replace('{images/img/img-1.png}','./layout/images/img/img-1.png',$html);
                    
                    //TESTEMUNHO DOIS

                    $html = str_replace('{name_dois}',$sections[1]['name'],$html);
                    $html = str_replace('{function_dois}',$sections[1]['function'],$html);
                    $html = str_replace('{title_dois}',$sections[1]['title'],$html);
                    $html = str_replace('{description_dois}',$sections[1]['description'],$html);
                    $html = str_replace('{images/user/img-2.jpg}','./layout/images/user/img-2.jpg',$html);
                    $html = str_replace('{images/img/img-2.png}','./layout/images/img/img-2.png',$html);

                    //TESTEMUNHO TRÊS

                    $html = str_replace('{name_tres}',$sections[2]['name'],$html);
                    $html = str_replace('{function_tres}',$sections[2]['function'],$html);
                    $html = str_replace('{title_tres}',$sections[2]['title'],$html);
                    $html = str_replace('{description_tres}',$sections[2]['description'],$html);
                    $html = str_replace('{images/user/img-3.jpg}','./layout/images/user/img-3.jpg',$html);
                    $html = str_replace('{images/img/img-3.png}','./layout/images/img/img-3.png',$html);

                    $html = str_replace('{css/bootstrap.min.css}','./layout/css/bootstrap.min.css',$html);
                    $html = str_replace('{css/materialdesignicons.min.css}','./layout/css/materialdesignicons.min.css',$html);
                    $html = str_replace('{css/tiny-slider.css}','./layout/css/tiny-slider.css',$html);
                    $html = str_replace('{css/style.min.css}','./layout/css/style.min.css',$html);
                    $html = str_replace('{css/colors/default.css}','./layout/css/colors/default.css',$html);
                    $html = str_replace('{./layout/js/bootstrap.bundle.min.js}','./layout/js/bootstrap.bundle.min.js',$html);
                    $html = str_replace('{./layout/js/tiny-slider.js}','./layout/js/tiny-slider.js',$html);
                    $html = str_replace('{./layout/js/swiper.min.js}','./layout/js/swiper.min.js',$html);
                    $html = str_replace('{./layout/plugin/components/jQuery/jquery-1.11.3.min.js}','./layout/plugin/components/jQuery/jquery-1.11.3.min.js',$html);
                    $html = str_replace('{./layout/js/app.js}','./layout/js/app.js',$html);

                    print $html;
                } catch (Exception $e) {
                    print $e->getMessage();
                }
            
        }

        public static function show(){
            self::load();
        }

    }

?>
