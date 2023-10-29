<?php

require_once './control/Connection.php';

class Usuarios{

    private $erroMessage; // Agora é uma propriedade privada da classe
    public $html;

    public function __construct() {
        $bootstrapCSS = file_get_contents('./layout/css/bootstrap.min.css');
        $mdiCSS = file_get_contents('./layout/css/materialdesignicons.min.css');
        $tinySliderCSS = file_get_contents('./layout/css/tiny-slider.css');
        $swiperCSS = file_get_contents('./layout/css/swiper.min.css');
        $customCSS = file_get_contents('./layout/css/style.min.css');
        $colorsCSS = file_get_contents('./layout/css/colors/default.css');

        // Carrega o conteúdo do arquivo HTML
        $html = file_get_contents('./html/Login.html');

        // Concatena o conteúdo dos arquivos CSS e HTML
        $styles = "<style>{$bootstrapCSS}{$mdiCSS}{$tinySliderCSS}{$swiperCSS}{$customCSS}{$colorsCSS}</style>";
        $this->html = "{$styles}{$html}";
    }

    public static function CadastroUsuario($pessoa) {
        $conn = Connection::getConnection();
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (empty($pessoa['cod_user'])) {
                $result = $conn->query("SELECT max(cod_user) as next FROM usuarios");
                $row = $result->fetch();
                $pessoa['cod_user'] = (int) $row['next'] + 1;
                $sql = "INSERT INTO usuarios(cod_user, login, password) VALUES (:cod_user, :login,  :password)";
            } else {
                $sql = "UPDATE usuarios SET 
                        cod_user = :cod_user,
                        login = :login,
                        password = :password
                        WHERE cod_user = :cod_user";
            }
            $result = $conn->prepare($sql);
            $result->execute([
                ':cod_user' => $pessoa['cod_user'],
                ':login' => $pessoa['login'],
                ':password' => $pessoa['password']
            ]);
            return $pessoa;
        }
    }
// pega as tabelas de usuario e
    public static function GetUserTable() {
        $conn = Connection::getConnection();
        $stmt = $conn->query("SELECT * FROM usuarios ORDER BY cod_user");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function ValidarLogin($param) {
        $conn = Connection::getConnection();
        $erroMessage = '';
    
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (isset($_POST['Usuario']) && isset($_POST['Senha'])) {
                // Se 'Usuario' e 'Senha' foram enviados via POST
                $usuario = $_POST['Usuario'];
                $senha = $_POST['Senha'];
    
                // Consulta SQL para verificar se o usuário e a senha existem na tabela de usuários
                $query = "SELECT * FROM usuarios WHERE login = :usuario AND password = :senha";
                $stmt = $conn->prepare($query);
                $stmt->bindParam(':usuario', $usuario);
                $stmt->bindParam(':senha', $senha);
                $stmt->execute();
    
                // Verifica se encontrou algum usuário com as credenciais fornecidas
                if ($stmt->rowCount() > 0) {
                    // Usuário válido
                    header("Location: index.php?class=Dashboard&method=show");
                } else {
                    // Usuário inválido, define a mensagem de erro
                    $erroMessage = "Usuário ou senha incorretos. Tente novamente.";
                }
        
                return $erroMessage;
                }  
            }   
        }
        public static function find($cod_user) {
            $conn = Connection::getConnection();
            $stmt = $conn->prepare("SELECT * FROM usuarios WHERE cod_user=:cod_user");
            $stmt->bindParam(':cod_user', $cod_user, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);

    }
        public static function delete($cod_user) {
                $conn = Connection::getConnection();
                $stmt = $conn->prepare("DELETE FROM usuarios WHERE cod_user=:cod_user");
                $stmt->bindParam(':cod_user', $cod_user, PDO::PARAM_INT);
                $stmt->execute();
                return "Dado excluído com sucesso";

        }
        public function show() {
            print 'foi';
        }
    
    }
    
        


