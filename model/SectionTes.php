<?php

require_once './control/Connection.php';



    class SectionTes{

        public static function save($reports){

            try {
                $conn = Connection::getConnection();

                $cod_test = (int) $reports['cod_test'];

                $conn->beginTransaction();

                $sql = "UPDATE secao_testemunho SET 
                        name = :name,
                        function = :function,
                        title = :title,
                        description = :description
                        WHERE cod_test = :cod_test;
                        ";

                $result = $conn->prepare($sql);

                $result->execute([':cod_test' => $cod_test,
                              ':name' => $reports['name'],
                              ':function' => $reports['function'],
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
                return $cod_test;
            } catch (Exception $e) {
                // Trata erros, se houver
                echo "Erro: " . $e->getMessage();
            }

        }

        public static function all(){
            $conn=Connection::getConnection();
            $result= $conn->query("SELECT * FROM secao_testemunho ORDER BY cod_test");
            return $result->fetchAll(PDO::FETCH_ASSOC);
        }

        public static function find($cod_test){
            $conn = Connection::getConnection();

            $sql = "SELECT * FROM secao_testemunho WHERE cod_test = :cod_test";
            
            $result = $conn->prepare($sql);
            $result->execute([':cod_test' => $cod_test]);

            return $result->fetch();
        }

        public function show(){
            $this->all();
        }

    }
?>