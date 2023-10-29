<?php

require_once './model/Preference.php';

//LISTAGEM FEITA!
//**FAZER FUNÇÃO DE EDIT!!**

    class PreferenceList{


        public function __construct(){ 
        }

        public static function load(){
                try {

                    $preferences = Preference::all();
                    
                    $html = file_get_contents('./html/formPreferences.html');

                    foreach ($preferences as $preference) {
                        foreach ($preference as $key => $value) {
                            echo $key;
                            $placeholder = '{'.$key.'}';
                            echo $placeholder;
                            $html = str_replace($placeholder, $value, $html);
                        }
                    }
                    
                    //print $html;

                    // $html = str_replace('{landing_title}', $preferences['landing_title'], $html);
                    // $html = str_replace('{favicon}', './layout/uploaded/'.$preferences['favicon'], $html);
                    // $html = str_replace('{header_logo}', './layout/uploaded/'.$preferences['header_logo'], $html);
                    // $html = str_replace('{link_facebook}', $preferences['link_facebook'], $html);
                    // $html = str_replace('{link_instagram}', $preferences['link_instagram'], $html);
                    // $html = str_replace('{section_home_title}', $preferences['section_home_title'], $html);
                    // $html = str_replace('{section_home_subtitle}', $preferences['section_home_subtitle'], $html);
                    // $html = str_replace('{section_home_img}', './layout/uploaded/'.$preferences['section_home_img'], $html);
                    // $html = str_replace('{section_home_carac_title}', $preferences['section_home_carac_title'], $html);
                    // $html = str_replace('{section_report_title}', $preferences['section_report_title'], $html);
                    // $html = str_replace('{section_appstore_title}', $preferences['section_appstore_title'], $html);
                    // $html = str_replace('{section_appstore_subtitle}', $preferences['section_appstore_subtitle'], $html);
                    // $html = str_replace('{section_appstore_img}', './layout/uploaded/'.$preferences['section_appstore_img'], $html);
                    // $html = str_replace('{section_appstore_img_app}', './layout/uploaded/'.$preferences['section_appstore_img_app'], $html);
                    // $html = str_replace('{section_appstore_img_play}', './layout/uploaded/'.$preferences['section_appstore_img_play'], $html);
                    // $html = str_replace('{phone_field}', $preferences['phone_field'], $html);
                    // $html = str_replace('{footer_logo}', './layout/uploaded/'.$preferences['footer_logo'], $html);
                    // $html = str_replace('{footer_copyright_field}', $preferences['footer_copyright_field'], $html);
                    // $html = str_replace('{footer_url_field}', $preferences['footer_url_field'], $html);
                    // $html = str_replace('{footer_powered_field}', $preferences['footer_powered_field'], $html);
            
                    print $html;
                } catch (Exception $e) {
                    print $e->getMessage();
                }
            
        }

        public static function show(){
            self::load();
        }
    
        public static function save($preferences){
            Preference::save($preferences);
            Preference::load();
        }
    }

?>