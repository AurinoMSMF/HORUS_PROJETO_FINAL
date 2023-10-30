<?php
class Caracteristicasform{
    private $html;
    private $data;

    public function __construct(){
    
        $this->html=file_get_contents('./model/formCaracteristicas.html');
        $this->data=[
            ':cod_carac' => null,
            ':title' => null,
            ':description' => null
        ];
    
    }

    public function edit($param){
        
        try{
            $id = (int) $param['cod_carac'];
            $Caracteristicas = Caracteristicas::find(1);
            $this->data = $Caracteristicas;
        }
        catch(Exception $e){
            print $e->getMessage();
        }

    }

    public function save($param){

        try{
            $id = Pessoa::save($param);
            $this->data=$param; 
            $this->data['cod_carac'] = $id;
        }
        catch(Exception $e){
            print $e->getMessage();
        }

    }

    public function show(){
        
        $this->html = str_replace('{cod_carac}', $this->data['cod_carac'], $this->html);
        $this->html = str_replace('{title}', $this->data['title'], $this->html);
        $this->html = str_replace('{description}', $this->data['description'], $this->html);
        $this->html = str_replace('{email}', $this->data['email'], $this->html);
        $this->html = str_replace('{endereco}', $this->data['endereco'], $this->html);
        $this->html = str_replace('{bairro}', $this->data['bairro'], $this->html);
        print $this->html;
    
    }

}