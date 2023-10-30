<?php

require_once './control/Connection.php';



    class Caracteristicas{

        public static function save($reports){

            try {
                $conn = Connection::getConnection();

                $cod_carac = (int) $reports['cod_carac'];

                $conn->beginTransaction();

                $sql = "UPDATE secao_home_carac SET 
                        title = :title,
                        description = :description
                        WHERE cod_carac = :cod_carac;
                        ";

                $result = $conn->prepare($sql);

                $result->execute([':cod_carac' => $cod_carac,
                              ':title' => $reports['title'],
                              ':description' => $reports['description'],
                ]);

                // $stmt->bindParam(':cod_test', $cod_test);
                // $stmt->bindParam(':name', $reports['name']);
                // $stmt->bindParam(':function', $reports['function']);
                // $stmt->bindParam(':title', $reports['title']);
                // $stmt->bindParam(':picture', $reports['picture']);
                // $stmt->bindParam(':background_img', $reports['background_img']);

                $conn->commit();
                return $cod_carac;
            } catch (Exception $e) {
                // Trata erros, se houver
                echo "Erro: " . $e->getMessage();
            }

        }

        public static function all(){
            $conn=Connection::getConnection();
            $result= $conn->query("SELECT * FROM secao_home_carac ORDER BY cod_carac");
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function find($cod_carac){
            $conn = Connection::getConnection();

            $sql = "SELECT * FROM secao_home_carac WHERE cod_carac = :cod_carac";
            
            $result = $conn->prepare($sql);
            $result->execute([':cod_carac' => $cod_carac]);

            return $result->fetch();
        }

        public function show(){
            $this->all();
        }

    }
?>