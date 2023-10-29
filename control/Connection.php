<?php

    abstract class Connection{
        
        protected static $conn;

        public static function getConnection(){

            if (empty(self::$conn)){

                $banco = parse_ini_file('./config/config.ini');
                $host = $banco['host'];
                $name = $banco['banco'];
                $user = $banco['usuario'];
                $pass = $banco['senha'];

                // self::$conn = new PDO("mysql:dbname={$name};user={$user};password={$pass};host={$host}");
                self::$conn = new PDO("mysql:host={$host};dbname={$name}", $user, $pass);

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
