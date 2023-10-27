<?php

    require_once '../control/Connection.class.php';

    class Preferences{

        private $preference;


        public static function save($preference){
            $conn = Connection::getConnection();

            if(empty($pessoa['id'])){
                $result= $conn->query("SELECT MAX(id) AS maior_id FROM Pessoa");
                $linha = $result->fetch();
                $pessoa['id'] = (int) $linha['maior_id'] +1; //incremento do maximo id já existente
                $sql = "INSERT INTO Pessoa (id, nome, telefone, email, endereco, bairro) VALUES (:id, :nome, :telefone, :email, :endereco, :bairro)";
            }
            else {
                $sql = "UPDATE Pessoa SET nome = :nome,
                telefone = :telefone,
                email = :email,
                bairro = :bairro,
                endereco = :endereco
                WHERE id = :id;
                ";
            }
            $result = $conn->prepare($sql);
            $result->execute([':id' => $pessoa['id'],
                              ':nome' => $pessoa['nome'],
                              ':telefone' => $pessoa['telefone'],
                              ':email' => $pessoa['email'],
                              ':endereco' => $pessoa['endereco'],
                              ':bairro' => $pessoa['bairro']
            ]);
            
            return $pessoa['id'];
        }



    }