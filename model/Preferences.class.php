<?php

    require_once '../control/Connection.class.php';

    class Preferences{

        private $preference;

        public static function save($preference){
            try{
                if ($conn = Connection::getConnection()){
                echo "CONEXÃO FUNCIONANDO";
                }

                echo "Dentro do metodo save";

                if(empty($preference['id'])){
                    if(isset($_FILES) && (!empty($preference['favicon']) && !empty($preference['header_logo']) && !empty($preference['section_home_img']) && !empty($preference['section_appstore_img']) && !empty($preference['section_appstore_img_app']) && !empty($preference['section_appstore_img_play']) && !empty($preference['footer_logo'])))
                    {

                        echo "ENTROU NO IF DO PREFERENCE";

                        $preference['favicon']= '../layout/images/' . $preference['favicon']['name'];
                        move_uploaded_file($preference['favicon']['tmp_name'], $preference['favicon']);

                        $preference['header_logo']="../layout/images/" . $preference['header_logo']['name'];
                        move_uploaded_file($preference['header_logo']['tmp_name'], $preference['header_logo']);

                        $preference['section_home_img']="../layout/images/" . $preference['section_home_img']['name'];
                        move_uploaded_file($preference['section_home_img']['tmp_name'], $preference['section_home_img']);

                        $preference['section_appstore_img']="../layout/images/" . $preference['section_appstore_img']['name'];
                        move_uploaded_file($preference['section_appstore_img']['tmp_name'], $preference['section_appstore_img']);

                        $preference['section_appstore_img_app']="../layout/images/" . $preference['section_appstore_img_app']['name'];
                        move_uploaded_file($preference['section_appstore_img_app']['tmp_name'], $preference['section_appstore_img_app']);

                        $preference['section_appstore_img_play']="../layout/images/" . $preference['section_appstore_img_play']['name'];
                        move_uploaded_file($preference['section_appstore_img_play']['tmp_name'], $preference['section_appstore_img_play']);

                        $preference['footer_logo']="../layout/images/" . $preference['footer_logo']['name'];
                        move_uploaded_file($preference['footer_logo']['tmp_name'], $preference['footer_logo']); 
                        $result= $conn->query("SELECT MAX(id) AS maior_id FROM preferencias");
                        $linha = $result->fetch();
                        $preference['id'] = (int) $linha['maior_id'] +1; //incremento do maximo id já existente
                        $sql = "INSERT INTO preferencias (
                            id, 
                            landing_title, 
                            favicon, 
                            header_logo, 
                            link_facebook, 
                            link_instagram,
                            section_home_title,
                            section_home_subtitle,
                            section_home_img,
                            section_home_carac_title,
                            section_report_title,
                            section_appstore_title,
                            section_appstore_subtitle,
                            section_appstore_img,
                            section_appstore_img_app,
                            section_appstore_img_play,
                            phone_field,
                            footer_logo,
                            footer_copyright_field,
                            footer_url_field,
                            footer_powered_field     
                        ) VALUES (
                            :id,
                            :landing_title,
                            :header_logo,
                            :link_facebook,
                            :link_instagram,
                            :section_home_title,
                            :section_home_subtitle,
                            :section_home_img,
                            :section_home_carac_title,
                            :section_report_title,
                            :section_appstore_title,
                            :section_appstore_subtitle,
                            :section_appstore_img,
                            :section_appstore_img_app,
                            :section_appstore_img_play,
                            :phone_field,
                            :footer_logo,
                            :footer_copyright_field,
                            :footer_url_field,
                            :footer_powered_field
                        )";
                    }
                    else{
                        echo "Não entrou no if das imagens do preference";
                    }
                    
                }
                else {
                    $sql = "UPDATE preferencias SET 
                    landing_title = :landing_title,
                    header_logo = :header_logo,
                    link_facebook = :link_facebook,
                    link_instagram = :link_instagram,
                    section_home_title = :section_home_title,
                    section_home_subtitle = :section_home_subtitle,
                    section_home_img = :section_home_img,
                    section_home_carac_title = :section_home_carac_title,
                    section_report_title = :section_report_title,
                    section_appstore_title = :section_appstore_title,
                    section_appstore_subtitle = :section_appstore_subtitle,
                    section_appstore_img = :section_appstore_img,
                    section_appstore_img_app = :section_appstore_img_app,
                    section_appstore_img_play = :section_appstore_img_play,
                    phone_field = :phone_field,
                    footer_logo = :footer_logo,
                    footer_copyright_field = :footer_copyright_field,
                    footer_url_field = :footer_url_field,
                    footer_powered_field = :footer_powered_field
                    WHERE id = :id;
                    ";
                }
                $result = $conn->prepare($sql);
                $result->execute([':id' => $preference['id'],
                                ':landing_title' => $preference['landing_title'],
                                ':header_logo' => $preference['header_logo'],
                                ':link_facebook' => $preference['link_facebook'],
                                ':link_instagram' => $preference['link_instagram'],
                                ':section_home_title' => $preference['section_home_title'],
                                ':section_home_subtitle' => $preference['section_home_subtitle'],
                                ':section_home_img' => $preference['section_home_img'],
                                ':section_home_carac_title' => $preference['section_home_carac_title'],
                                ':section_report_title' => $preference['section_report_title'],
                                ':section_appstore_title' => $preference['section_appstore_title'],
                                ':section_appstore_subtitle' => $preference['section_appstore_subtitle'],
                                ':section_appstore_img' => $preference['section_appstore_img'],
                                ':section_appstore_img_app' => $preference['section_appstore_img_app'],
                                ':section_appstore_img_play' => $preference['section_appstore_img_play'],
                                ':phone_field' => $preference['phone_field'],
                                ':footer_logo' => $preference['footer_logo'],
                                ':footer_copyright_field' => $preference['footer_copyright_field'],
                                ':footer_url_field' => $preference['footer_url_field'],
                                ':footer_powered_field' => $preference['footer_powered_field'],
                ]);
                
                //Connection::closeConnection();

                return $preference['id'];
            }
            catch(Exception $e){
                print $e->getMessage();
            }


            
        }

        public static function find($id){
            $conn = Connection::getConnection();

            $sql = "SELECT * FROM preferencias WHERE id = :id";
            
            $result = $conn->prepare($sql);
            $result->execute([':id' => $id]);

            return $result->fetch();
        }

        public static function all(){
            $conn=Connection::getConnection();
            $result= $conn->query("SELECT * FROM preferencias ORDER BY id");

            return $result->fetchAll();
        }

    }