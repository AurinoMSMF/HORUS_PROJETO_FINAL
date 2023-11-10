<?php

require_once './control/Connection.php';
require_once './control/UsuariosLogin.php';


class Contato {

    private $erroMessage; // Agora é uma propriedade privada da classe
    public $html;

    public function __construct() {
    }

    public static function CadastroContato($contato) {
        $conn = Connection::getConnection();
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Verifique se os campos do formulário não estão vazios
            if (empty($contato['name']) || empty($contato['email']) || empty($contato['phone']) || empty($contato['message'])) {
                // Se algum campo estiver vazio, retorne uma mensagem de erro ou faça o que for apropriado para o seu caso.
                return "Todos os campos do formulário são obrigatórios.";
            }
    
            $dataAtual = date('Y-m-d H:i:s');
            $result = $conn->query("SELECT max(cod_msg) as next FROM secao_contato");
            $row = $result->fetch();
            $cod_msg = (int) $row['next'] + 1;
    
            $sql = "INSERT INTO secao_contato(cod_msg, name, email, phone, message, date) VALUES (:cod_msg, :name, :email, :phone, :message, :date)";
    
            // Prepare e execute a consulta SQL
            $result = $conn->prepare($sql);
            $result->execute([
                ':cod_msg' => $cod_msg,  // Use a variável $cod_msg diretamente
                ':name' => $contato['name'],
                ':email' => $contato['email'],
                ':phone' => $contato['phone'],
                ':message' => $contato['message'],
                ':date' => $dataAtual
            ]);
    
            return "Cadastro de contato realizado com sucesso!";
        }
    }
        public static function find($cod_user) {
            $conn = Connection::getConnection();
            $stmt = $conn->prepare("SELECT * FROM usuarios WHERE cod_user=:cod_user");
            $stmt->bindParam(':cod_user', $cod_user, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);

    }

    }