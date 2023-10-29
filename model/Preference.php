<?php

require_once './control/Connection.php';

class Preference{

        public static function save($preferences){
            // Suponha que você tenha recebido os dados do formulário via POST em $preferences
            try {
                $conn = Connection::getConnection();
            
                // Suponha que $preferences contém campos de texto e imagens recebidos via POST
                $id = 1;
            
                // Atualize os campos de texto no banco de dados
                $sql = "UPDATE preferencias SET 
                        landing_title = :landing_title,
                        link_facebook = :link_facebook,
                        link_instagram = :link_instagram,
                        section_home_title = :section_home_title,
                        section_home_subtitle = :section_home_subtitle,
                        section_home_carac_title = :section_home_carac_title,
                        section_report_title = :section_report_title,
                        section_appstore_title = :section_appstore_title,
                        section_appstore_subtitle = :section_appstore_subtitle,
                        phone_field = :phone_field,
                        footer_copyright_field = :footer_copyright_field,
                        footer_url_field = :footer_url_field,
                        footer_powered_field = :footer_powered_field
                        WHERE id = :id;";
            
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':landing_title', $preferences['landing_title']);
                $stmt->bindParam(':link_facebook', $preferences['link_facebook']);
                $stmt->bindParam(':link_instagram', $preferences['link_instagram']);
                $stmt->bindParam(':section_home_title', $preferences['section_home_title']);
                $stmt->bindParam(':section_home_subtitle', $preferences['section_home_subtitle']);
                $stmt->bindParam(':section_home_carac_title', $preferences['section_home_carac_title']);
                $stmt->bindParam(':section_report_title', $preferences['section_report_title']);
                $stmt->bindParam(':section_appstore_title', $preferences['section_appstore_title']);
                $stmt->bindParam(':section_appstore_subtitle', $preferences['section_appstore_subtitle']);
                $stmt->bindParam(':phone_field', $preferences['phone_field']);
                $stmt->bindParam(':footer_copyright_field', $preferences['footer_copyright_field']);
                $stmt->bindParam(':footer_url_field', $preferences['footer_url_field']);
                $stmt->bindParam(':footer_powered_field', $preferences['footer_powered_field']);
                $stmt->bindParam(':id', $id);
                $stmt->execute();
            
                // Atualize as imagens no banco de dados
                $imagens = $_FILES; // O array $_FILES contém todas as imagens enviadas via formulário

                echo "Depois do array de imagens";

                var_dump($imagens);

                // foreach ($imagens as $campo => $info_imagem) {
                //     if ($info_imagem['error'] === 0) {
                //         $extensao = strtolower(substr($info_imagem['name'], -4));
                //         if ($extensao === ".png" || $extensao === ".jpg" || $extensao === ".jpeg") {
                //             $novo_nome = md5(time()) . $extensao;
                //             $diretorio = "./layout/uploaded/";

                //             move_uploaded_file($info_imagem['tmp_name'], $diretorio . $novo_nome);

                //             // Atualize o campo de imagem correspondente no banco de dados
                //             $sql = "UPDATE preferencias SET $campo = :imagem WHERE id = :id";
                //             $stmt = $conn->prepare($sql);
                //             $stmt->bindParam(':imagem', $novo_nome);
                //             $stmt->bindParam(':id', 1);
                //             $stmt->execute();
                //         } else {
                //             echo "O arquivo no campo $campo deve ser uma imagem PNG, JPG ou JPEG.";
                //         }
                //     }
                // }
            
                // Feche a conexão
                $conn = null;
                unset($_FILES);
                // Redirecione para uma página de sucesso, se necessário
                header("Location: ./index.php?class=PreferenceList&method=show");
                exit();
            } catch (Exception $e) {
                // Trate erros, se houver
                echo "Erro: " . $e->getMessage();
            }            

        }

        // public static function save($preference){
        //      try{
        //         $conn=Connection::getConnection();
        //         $conn->beginTransaction();
        //          if ($conn){
        //              $sql = "UPDATE preferencias SET 
        //              favicon = :favicon,
        //              landing_title = :landing_title,
        //              header_logo = :header_logo,
        //              link_facebook = :link_facebook,
        //              link_instagram = :link_instagram,
        //              section_home_title = :section_home_title,
        //              section_home_subtitle = :section_home_subtitle,
        //              section_home_img = :section_home_img,
        //              section_home_carac_title = :section_home_carac_title,
        //              section_report_title = :section_report_title,
        //              section_appstore_title = :section_appstore_title,
        //              section_appstore_subtitle = :section_appstore_subtitle,
        //              section_appstore_img = :section_appstore_img,
        //              section_appstore_img_app = :section_appstore_img_app,
        //              section_appstore_img_play = :section_appstore_img_play,
        //              phone_field = :phone_field,
        //              footer_logo = :footer_logo,
        //              footer_copyright_field = :footer_copyright_field,
        //              footer_url_field = :footer_url_field,
        //              footer_powered_field = :footer_powered_field
        //              WHERE id = :id;
        //              ";
        //          }
        //          $result = $conn->prepare($sql);
        //          $result->execute([':id' => $preference['id'],
        //                         'favicon' => $preference['favicon'],
        //                         ':landing_title' => $preference['landing_title'],
        //                         ':header_logo' => $preference['header_logo'],
        //                         ':link_facebook' => $preference['link_facebook'],
        //                         ':link_instagram' => $preference['link_instagram'],
        //                         ':section_home_title' => $preference['section_home_title'],
        //                         ':section_home_subtitle' => $preference['section_home_subtitle'],
        //                         ':section_home_img' => $preference['section_home_img'],
        //                         ':section_home_carac_title' => $preference['section_home_carac_title'],
        //                         ':section_report_title' => $preference['section_report_title'],
        //                         ':section_appstore_title' => $preference['section_appstore_title'],
        //                         ':section_appstore_subtitle' => $preference['section_appstore_subtitle'],
        //                         ':section_appstore_img' => $preference['section_appstore_img'],
        //                         ':section_appstore_img_app' => $preference['section_appstore_img_app'],
        //                         ':section_appstore_img_play' => $preference['section_appstore_img_play'],
        //                         ':phone_field' => $preference['phone_field'],
        //                         ':footer_logo' => $preference['footer_logo'],
        //                         ':footer_copyright_field' => $preference['footer_copyright_field'],
        //                         ':footer_url_field' => $preference['footer_url_field'],
        //                         ':footer_powered_field' => $preference['footer_powered_field'],
        //          ]);
                
        //          Connection::closeConnection();

        //          //return $preference['id'];      
        //         }
        //         catch(Exception $e){
        //             $conn->rollBack();
        //             print $e->getMessage();
        //         }
        //     }           
    
            public static function all(){
                $conn=Connection::getConnection();
                $result= $conn->query("SELECT * FROM preferencias LIMIT 1");
       
                //print_r($result->fetch(PDO::FETCH_ASSOC));
                return $result->fetch(PDO::FETCH_ASSOC);
            }

            public function show(){
                $this->all();
            }

        }
