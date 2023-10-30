<?php

require_once './model/Contato.php';

class EnvioContato {
    public $List;
    public $Cadastro;
    private $items;
    private $data;
    private $teste;


    public function __construct() {
        // Carrega o conteúdo do arquivo HTML
        $List = file_get_contents('./html/ListContatos.html');
        $this->List = "{$List}";

    }
    public static function GetUserTable() {
        $conn = Connection::getConnection();
        $stmt = $conn->query("SELECT * FROM secao_contato ORDER BY cod_msg");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function load() {
        try {
            $pessoas = EnvioContato::GetUserTable();
            $items = '';
        foreach ($pessoas as $pessoa) {
            $item = file_get_contents('./html/ItemsContato.html');
            $item = str_replace('{cod_msg}', $pessoa['cod_msg'], $item);
            $item = str_replace('{name}', $pessoa['name'], $item);
            $item = str_replace('{email}', $pessoa['email'], $item);
            $item = str_replace('{phone}', $pessoa['phone'], $item);
            $item = str_replace('{message}', $pessoa['message'], $item);
            $items.= $item;
            }
            $this->List = str_replace('{items}', $items, $this->List);
        }
        catch (Exception $e) {
        print $e->getMessage();
    }
}
    
    public function EnviarParametros($param) {
        // Chama a função CadastroContato passando o array $param como argumento
        $mensagem = Contato::CadastroContato($param);
        header("Location: index.php");

    }
    public function PuxarDashboard() {
        $cadastroListagemUsuario = new Dashboard();
        $this->teste = $cadastroListagemUsuario->show();
    }

    public function show() {
        $this->load();
        $this->PuxarDashboard();
    
        $conteudo = '<div style="display: flex; flex-direction: column; justify-content: center; 
        padding-left: 100px;">';
        $conteudo .= $this->teste;   
        $conteudo .= $this->List;
        $conteudo .= '</div>';
    
    
        print $conteudo;
}
}