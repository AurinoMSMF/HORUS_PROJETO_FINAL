<?php

    abstract class Connection{
        
        private static $conn;

        public static function getConnection(){

            if (empty(self::$conn)){

                $banco = parse_ini_file('config/config.ini');
                $host = $banco['host'];
                $name = $banco['name'];
                $user = $banco['user'];
                $pass = $banco['pass'];

                self::$conn = new PDO("mysql:dbname={$name};user={$user};password={$pass};host={$host}");
                self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            }

            return self::$conn;
        }
    }