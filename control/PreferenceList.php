<?php

require_once './model/Preference.php';


    class PreferenceList{

        //private $html;

        public function __construct(){ 
        }

        public static function load(){
                try {
                    $preferences = Preference::all();
                    //echo $preferences['landing_title'];
                    $html = file_get_contents('./layout/index.html');
                    //print $html;
                    //var_dump($html);
                    foreach ($preferences as $preference) {
                        //echo $preference['landing_title'];
                        $html = str_replace('{landing_title}', $preferences['landing_title'], $html);
                        $html = str_replace('{link_facebook}', $preferences['link_facebook'], $html);
                        $html = str_replace('{link_instagram}', $preferences['link_instagram'], $html);
                        // Adicione mais substituições conforme necessário para outras colunas do banco de dados.
                    }
            
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