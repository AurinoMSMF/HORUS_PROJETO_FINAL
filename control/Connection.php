<?php

    abstract class Connection{
        
        protected static $conn;

        public static function getConnection() {
            if (empty(self::$conn)) {
                $conexao = parse_ini_file('./config/config.ini');
                $host = $conexao['host']; // Endereço do servidor MySQL
                $usuario = $conexao['usuario'];   // Nome de usuário do MySQL
                $senha = $conexao['senha'];      // Senha do MySQL
                $banco = $conexao['banco'];// Nome do seu banco de dados        
                self::$conn = new PDO("mysql:host={$host};dbname={$banco}", $usuario, $senha);
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }
            return self::$conn;
        }

        public static function closeConnection(){
            if(!empty(self::$conn)){
                self::$conn=null;
            }
        }
    }