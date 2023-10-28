<?php

include_once '../model/Preference.php';

class PreferenceList{

    private $html;

    public function __construct(){
        $this->show();
    }

    public function load(){
        try{
            $preferences=Preference::all();
            $this->html = file_get_contents('../layout/index.html');
            foreach($preferences as $preference){
                $this->html = str_replace('{landing_title}',$preference['landing_title'],$this->html);
                $this->html = str_replace('{link_facebook}',$preference['link_facebook'],$this->html);
                $this->html = str_replace('{link_instagram}',$preference['link_instagram'],$this->html);
            }
            //$this->html = str_replace('{items}', $items, $this->html);
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