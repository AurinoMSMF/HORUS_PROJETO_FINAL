<?php
require 'Connection.php'; // Inclua o arquivo que contém a classe Connection

try {
    // Tente estabelecer uma conexão com o banco de dados
    $db = Connection::getConnection();

    // Execute uma consulta de teste
    $query = "SELECT * FROM preferencias LIMIT 1";
    $result = $db->query($query);

    // Verifique se a consulta foi bem-sucedida
    if ($result) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        if ($row) {
            echo "Conexão com o banco de dados bem-sucedida. Dados de teste: ";
            print_r($row);
        } else {
            echo "Nenhum dado encontrado na tabela de teste.";
        }
    } else {
        echo "Falha na consulta: " . $db->errorInfo()[2];
    }

    // Feche a conexão
    Connection::closeConnection();
} catch (PDOException $e) {
    echo "Erro na conexão com o banco de dados: " . $e->getMessage();
}
?>
