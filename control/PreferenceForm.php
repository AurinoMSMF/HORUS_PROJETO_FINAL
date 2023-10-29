<?php
class PreferenceForm{
    private $html;
    private $data;

    public function __construct(){
    
        $this->html=file_get_contents('./model/formPreferences.html');
        $this->data=[
            ':id' => null,
            ':favicon' => null,
            ':landing_title' => null,
            ':header_logo' => null,
            ':link_facebook' => null,
            ':link_instagram' => null,
            ':section_home_title' => null,
            ':section_home_subtitle' => null,
            ':section_home_img' => null,
            ':section_home_carac_title' => null,
            ':section_report_title' => null,
            ':section_appstore_title' => null,
            ':section_appstore_subtitle' => null,
            ':section_appstore_img' => null,
            ':section_appstore_img_app' => null,
            ':section_appstore_img_play' => null,
            ':phone_field' => null,
            ':footer_logo' => null,
            ':footer_copyright_field' => null,
            ':footer_url_field' => null,
            ':footer_powered_field' => null,
        ];
    
    }

    public function edit($param){
        
        try{
            $id = (int) $param['id'];
            $preference = Preference::find(1);
            $this->data = $preference;
        }
        catch(Exception $e){
            print $e->getMessage();
        }

    }

    public function save($param){

        try{
            $id = Pessoa::save($param);
            $this->data=$param; 
            $this->data['id'] = $id;
        }
        catch(Exception $e){
            print $e->getMessage();
        }

    }

    public function show(){
        
        $this->html = str_replace('{id}', $this->data['id'], $this->html);
        $this->html = str_replace('{nome}', $this->data['nome'], $this->html);
        $this->html = str_replace('{telefone}', $this->data['telefone'], $this->html);
        $this->html = str_replace('{email}', $this->data['email'], $this->html);
        $this->html = str_replace('{endereco}', $this->data['endereco'], $this->html);
        $this->html = str_replace('{bairro}', $this->data['bairro'], $this->html);
        print $this->html;
    
    }

}