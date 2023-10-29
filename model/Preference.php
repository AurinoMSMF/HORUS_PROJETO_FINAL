<?php

    require_once '../control/Connection.php';

    Connection::saudacao();

    abstract class Preferences{

        public function __construct(){
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
                $result= $conn->query("SELECT * FROM preferencias ORDER BY id");
    
                return $result->fetchAll();
            }

        }
