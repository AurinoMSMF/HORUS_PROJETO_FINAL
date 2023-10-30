<?php

require_once './control/Connection.php';



class Preference{

        public static function save($preferences){
    
            try {
                $conn = Connection::getConnection();

                $id = 1;

                $conn->beginTransaction();

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

                    // Processar e atualizar imagens
                    echo $_FILES[0];
                    if (isset($_FILES)) {
                       
                        foreach ($_FILES as $images){
                            $diretorio = "./layout/uploaded/";
        
                            // Atualizar a imagem do favicon
                            if (!empty($_FILES['favicon']['type']) && $_FILES['favicon'] && $_FILES['favicon']['error']===0) {
        
                                $extensao = strtolower(substr($_FILES['favicon']['name'], -4));
                                $novo_nome = hash('sha256', time()) . $extensao;
                                move_uploaded_file($_FILES['favicon']['tmp_name'], $diretorio . $novo_nome);
                                $sql_favicon = "UPDATE preferencias SET favicon = :favicon WHERE id = :id";
                                $stmt = $conn->prepare($sql_favicon);
                                $stmt->bindParam(':favicon', $novo_nome);
                                $stmt->bindParam(':id', $id);
                                $stmt->execute();
        
                            }else{
                                
                            }
        
                            // Atualizar a imagem do header_logo
                            if (!empty($_FILES['header_logo']['type']) && $_FILES['header_logo'] && $_FILES['header_logo']['error']===0) {
        
                                $extensao = strtolower(substr($_FILES['header_logo']['name'], -4));
                                $novo_nome = md5(time()) . $extensao;
                                move_uploaded_file($_FILES['header_logo']['tmp_name'], $diretorio . $novo_nome);
                                $sql_header_logo = "UPDATE preferencias SET header_logo = :header_logo WHERE id = :id";
                                $stmt = $conn->prepare($sql_header_logo);
                                $stmt->bindParam(':header_logo', $novo_nome);
                                $stmt->bindParam(':id', $id);
                                $stmt->execute();
        
                            }else{
                                
                            }
        
                            if(!empty($_FILES['section_home_img']['type']) && $_FILES['section_home_img'] && $_FILES['section_home_img']['error']===0){
        
                                $extensao = strtolower(substr($_FILES['section_home_img']['name'],-4));
                                $novo_nome=md5(time()) . $extensao;
                                $diretorio = "./layout/uploaded/";
                                
                                move_uploaded_file($_FILES['section_home_img']['tmp_name'], $diretorio.$novo_nome);
                            
                                $sql_section_home_img = "UPDATE preferencias SET section_home_img = :section_home_img WHERE id = :id";
                                $stmt = $conn->prepare($sql_section_home_img);
                                $stmt->bindParam(':section_home_img', $novo_nome);
                                $stmt->bindParam(':id', $id);
                                $stmt->execute();
        
                            }else{
                                
                            }
                            
                            if(!empty($_FILES['section_appstore_img']['type']) && $_FILES['section_appstore_img'] && $_FILES['section_appstore_img']['error']===0){
        
                                $extensao = strtolower(substr($_FILES['section_appstore_img']['name'],-4));
                                $novo_nome=md5(time()) . $extensao;
                                $diretorio = "./layout/uploaded/";
                                
                                move_uploaded_file($_FILES['section_appstore_img']['tmp_name'], $diretorio.$novo_nome);
                            
                                $sql_section_appstore_img = "UPDATE preferencias SET section_appstore_img = :section_appstore_img WHERE id = :id";
                                $stmt = $conn->prepare($sql_section_appstore_img);
                                $stmt->bindParam(':section_appstore_img', $novo_nome);
                                $stmt->bindParam(':id', $id);
                                $stmt->execute();
        
                            }else{
                                
                            }
                            
                            if(!empty($_FILES['section_appstore_img_app']['type']) && $_FILES['section_appstore_img_app'] && $_FILES['section_appstore_img_app']['error']===0){
        
                                $extensao = strtolower(substr($_FILES['section_appstore_img_app']['name'],-4));
                                $novo_nome=md5(time()) . $extensao;
                                $diretorio = "./layout/uploaded/";
                                
                                move_uploaded_file($_FILES['section_appstore_img_app']['tmp_name'], $diretorio.$novo_nome);
                            
                                $sql_section_appstore_img_app = "UPDATE preferencias SET section_appstore_img_app = :section_appstore_img_app WHERE id = :id";
                                $stmt = $conn->prepare($sql_section_appstore_img_app);
                                $stmt->bindParam(':section_appstore_img_app', $novo_nome);
                                $stmt->bindParam(':id', $id);
                                $stmt->execute();
        
                            }else{
                                
                            }
                            
                            if(!empty($_FILES['section_appstore_img_play']['type']) && $_FILES['section_appstore_img_play'] && $_FILES['section_appstore_img_play']['error']===0){
        
                                $extensao = strtolower(substr($_FILES['section_appstore_img_play']['name'],-4));
                                $novo_nome=md5(time()) . $extensao;
                                $diretorio = "./layout/uploaded/";
                                
                                move_uploaded_file($_FILES['section_appstore_img_play']['tmp_name'], $diretorio.$novo_nome);
                            
                                $sql_section_appstore_img_play = "UPDATE preferencias SET section_appstore_img_play = :section_appstore_img_play WHERE id = :id";
                                $stmt = $conn->prepare($sql_section_appstore_img_play);
                                $stmt->bindParam(':section_appstore_img_play', $novo_nome);
                                $stmt->bindParam(':id', $id);
                                $stmt->execute();
        
                            }else{
                                
                            }
                            
                            if(!empty($_FILES['footer_logo']['type']) && $_FILES['footer_logo'] && $_FILES['footer_logo']['error']===0){
        
                                $extensao = strtolower(substr($_FILES['footer_logo']['name'],-4));
                                $novo_nome=md5(time()) . $extensao;
                                $diretorio = "./layout/uploaded/";
                                
                                move_uploaded_file($_FILES['footer_logo']['tmp_name'], $diretorio.$novo_nome);
                            
                                $sql_footer_logo = "UPDATE preferencias SET footer_logo = :footer_logo WHERE id = :id";
                                $stmt = $conn->prepare($sql_footer_logo);
                                $stmt->bindParam(':footer_logo', $novo_nome);
                                $stmt->bindParam(':id', $id);
                                $stmt->execute();
        
                            }else{
                                
                            }
                        }

                        $conn->commit(); // Confirma a transação
                    }
                // Feche a conexão
                $conn = null;
                //var_dump($_FILES);
                unset($_FILES);
                // Redirecione para uma página de sucesso, se necessário
                header("Location: ./index.php?class=PreferenceList&method=show");
                exit();
            } catch (Exception $e) {
                // Trate erros, se houver
                echo "Erro: " . $e->getMessage();
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
