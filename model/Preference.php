<?php

require_once './control/Connection.php';

class Preference{

        public static function saveDois($preferences){
            $conn = Connection::getConnection();
            try{        
                if(isset($_FILES)){

                    foreach ($preferences as $preference){
                        $extensao = strtolower(substr($preferences[$preference]['name'],-4));
                        if($extensao ===".png"){
                            $novo_nome=md5(time()) . $extensao;
                            $diretorio = "./";
                            
                            move_uploaded_file($preference['tmp_name'], $diretorio.$novo_nome);
                            
                            $sql_code = "UPDATE preferencias SET $preferences[$preference] = '$novo_nome' WHERE id =1";
                            $result = $conn->prepare($sql);
                            $result->execute();
                        }else{
                            $sql_code = "UPDATE preferencias SET $preference = '{$preferences[$preference]}'";
                            $result = $conn->prepare($sql);
                            $result->execute();
                        }
                    }
                }else{
                    echo "Problema com FILE";
                }
            }
            catch(Exception $e){
                $conn->rollBack();
                print $e->getMessage();
            }
        }

        public static function save($preference){
             try{
                $conn=Connection::getConnection();
                $conn->beginTransaction();
                 if ($conn){
                     $sql = "UPDATE preferencias SET 
                     favicon = :favicon,
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
                                'favicon' => $preference['favicon'],
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
                
                 Connection::closeConnection();

                 //return $preference['id'];      
                }
                catch(Exception $e){
                    $conn->rollBack();
                    print $e->getMessage();
                }
            }           
    
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
