<?php

$servername = "localhost"; // Nome do servidor
$username = "root"; // Nome de usuário do banco de dados
$password = ""; // Senha do banco de dados
$database = "PROJETO_FINAL"; // Nome do banco de dados

// Crie uma conexão
$conn = new mysqli($servername, $username, $password, $database);

// Verifique a conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

if(isset($_FILES)){
    var_dump($_FILES);
    echo "footer_logo <br>";
    $extensao = strtolower(substr($_FILES['footer_logo']['name'],-4));
    $novo_nome=md5(time()) . $extensao;
    $diretorio = "./";
    
    move_uploaded_file($_FILES['footer_logo']['tmp_name'], $diretorio.$novo_nome);

    $sql_code = "UPDATE preferencias SET footer_logo = '$novo_nome'";
    if ($conn->query($sql_code)) {
            echo "FUNCIONOU";
    } else {
            echo "NÃO FUNCIONOU: " . $conn->error;
    }
}

?>

<h1>
upload de imagens
</h1>

<form action="upload.php" method="post" enctype="multipart/form-data">
<!-- FAVICON: <input type="file" name="favicon" id=""><br><hr> -->
<!-- LOGO HEADER: <input type="file" name="header_logo" id=""><br><hr> 
 SECTION HOME IMG: <input type="file" name="section_home_img" id=""><br><hr>
SECTION APP STORE IMG: <input type="file" name="section_appstore_img" id=""><br><hr>
SECTION APP STORE IMG APP: <input type="file" name="section_appstore_img_app" id=""><br><hr>
SECTION APP STORE IMG PLAY: <input type="file" name="section_appstore_img_play" id=""><br><hr>-->
FOOTER LOGO: <input type="file" name="footer_logo" id=""><br><hr>
<input type="submit" value="Enviar">
</form>